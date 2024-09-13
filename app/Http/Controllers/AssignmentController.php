<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Group;
use App\Models\Course;
use App\Models\Assignment;
use Illuminate\Http\Request;
use App\Models\StudentAssignment;
use App\Models\StudentSubmission;
use App\Models\AssignmentResponse;
use Illuminate\Support\Facades\Auth;

class AssignmentController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Si l'utilisateur est admin, il peut voir tous les devoirs
        if ($user->hasRole('Administrator (can create other users)')) {
            $assignments = Assignment::all();
        } else {
            // Si l'utilisateur est étudiant, il voit les devoirs qui lui sont assignés
            $assignments = Assignment::whereHas('students', function ($query) use ($user) {
                $query->where('student_id', $user->id);
            })->get();
        }

        return view('assignments.index', compact('assignments'));
    }

    public function create()
    {
        // Seuls les enseignants et les admins peuvent créer des devoirs
        $this->authorize('create', Assignment::class);

        $courses = Course::all(); // Les cours disponibles
        $groups = Group::all();   // Les groupes disponibles

        return view('assignments.create', compact('courses', 'groups'));
    }

    public function store(Request $request)
    {
        $this->authorize('create', Assignment::class);

        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'due_date' => 'required|date',
            'course_ids' => 'array|exists:courses,id',
            'group_ids' => 'array|exists:groups,id',
        ]);

        // Créer un nouvel assignment
        $assignment = Assignment::create($request->only(['title', 'description', 'due_date']));

        // Assigner aux groupes
        if ($request->has('group_ids')) {
            foreach ($request->group_ids as $group_id) {
                $group = Group::find($group_id);
                $students = $group->students;
                foreach ($students as $student) {
                    StudentAssignment::updateOrCreate(
                        [
                            'assignment_id' => $assignment->id,
                            'student_id' => $student->id,
                            'group_id' => $group_id
                        ],
                        ['status' => 'assigned']
                    );
                }
            }
        }

        // Assigner aux cours (optionnel selon votre logique)
        if ($request->has('course_ids')) {
            foreach ($request->course_ids as $course_id) {
                $course = Course::find($course_id);
                $students = $course->students;
                foreach ($students as $student) {
                    StudentAssignment::updateOrCreate(
                        [
                            'assignment_id' => $assignment->id,
                            'student_id' => $student->id,
                            'group_id' => null // Si on veut garder group_id vide ici
                        ],
                        ['status' => 'assigned']
                    );
                }
            }
        }

        return redirect()->route('assignments.index')->with('success', 'Devoir créé avec succès.');
    }

    public function submissions($assignment_id)
    {
        $assignment = Assignment::findOrFail($assignment_id);
    
        // Récupérer les soumissions avec les utilisateurs qui ont soumis une réponse
        $submissions = AssignmentResponse::where('assignment_id', $assignment_id)
                            ->with('user')
                            ->get();
    
        // Vérifier s'il y a des soumissions
        if ($submissions->isEmpty()) {
            return view('assignments.submission_list', compact('assignment'))
                ->with('message', 'Aucune soumission pour ce devoir.');
        }
    
        return view('assignments.submission_list', compact('assignment', 'submissions'));
    }
    

    public function submissionDetail($assignment_id, $student_id)
    {
        $assignment = Assignment::findOrFail($assignment_id);

        // Récupérer la soumission de l'étudiant
        $submission = AssignmentResponse::where('assignment_id', $assignment_id)
            ->where('user_id', $student_id)
            ->firstOrFail();

        return view('assignments.submission_detail', compact('assignment', 'submission'));
    }

    public function submitGrade(Request $request, $assignment_id, $student_id)
    {
        $request->validate([
            'grade' => 'required|numeric|min:0|max:100',
        ]);

        $submission = AssignmentResponse::where('assignment_id', $assignment_id)
            ->where('user_id', $student_id)
            ->firstOrFail();

        // Mettre à jour la note de la soumission
        $submission->update([
            'grade' => $request->input('grade'),
        ]);

        return redirect()->route('assignments.submissions', $assignment_id)
            ->with('success', 'Note soumise avec succès');
    }



    public function showSubmissions($assignmentId)
    {
        // Assurez-vous que l'ID du devoir est valide
        $assignment = Assignment::findOrFail($assignmentId);

        // Récupérez les soumissions liées à ce devoir
        $submissions = StudentSubmission::where('assignment_id', $assignmentId)->get();

        return view('assignments.submissions', compact('assignment', 'submissions'));
    }

    public function submissionPage($assignmentId)
    {
        $assignment = Assignment::findOrFail($assignmentId);
        $studentAssignment = StudentAssignment::where('assignment_id', $assignmentId)
            ->where('student_id', auth()->id())
            ->firstOrFail();

        return view('assignments.submit', compact('assignment', 'studentAssignment'));
    }

    public function viewSubmissions($assignmentId)
    {
        $assignment = Assignment::with('students')->findOrFail($assignmentId);

        // Ensure the professor is authorized to view the submissions
        $this->authorize('viewSubmissions', $assignment);

        $submissions = $assignment->submissions; // Récupère les soumissions pour l'assignation
        // Get all student assignments
        $studentAssignments = StudentAssignment::with('student', 'submissions')
            ->where('assignment_id', $assignmentId)
            ->get();

        return view('assignments.submissions', compact('assignment', 'submissions', 'studentAssignments'));
    }


    public function assignToGroups(Request $request)
    {
        $assignment = Assignment::find($request->assignment_id);
        $groupIds = array_unique($request->group_ids); // Utilisez array_unique pour éviter les doublons

        foreach ($groupIds as $groupId) {
            $assignment->groups()->syncWithoutDetaching([$groupId]);

            // Assigner le devoir aux étudiants du groupe
            $students = Group::find($groupId)->students;
            foreach ($students as $student) {
                StudentAssignment::updateOrCreate(
                    ['assignment_id' => $assignment->id, 'student_id' => $student->id],
                    ['group_id' => $groupId, 'status' => 'assigned']
                );
            }
        }

        return redirect()->back()->with('success', 'Devoir assigné aux groupes avec succès.');
    }

    public function assignToGroupsAndStudents(Request $request)
    {
        $assignment = Assignment::find($request->assignment_id);
        $groupIds = $request->group_ids; // IDs des groupes sélectionnés

        foreach ($groupIds as $groupId) {
            $group = Group::find($groupId);
            $assignment->groups()->syncWithoutDetaching([$groupId]);

            // Assigner le devoir aux étudiants du groupe
            foreach ($group->students as $student) {
                $student->assignments()->syncWithoutDetaching([$assignment->id]);
            }
        }

        return redirect()->back()->with('success', 'Devoir assigné aux groupes et aux étudiants avec succès.');
    }


    public function show($id)
    {
        $assignment = Assignment::with('groups')->findOrFail($id);

        // Autoriser uniquement les étudiants assignés ou enseignants du cours
        $this->authorize('view', $assignment);

        return view('assignments.show', compact('assignment'));
    }

    public function submit(Request $request, $assignmentId)
    {
        $request->validate([
            'response' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx',
        ]);

        // Trouver l'entrée de l'assignation étudiant
        $studentAssignment = StudentAssignment::where('assignment_id', $assignmentId)
            ->where('student_id', auth()->id())
            ->firstOrFail();

        // Stockage du fichier soumis
        $filePath = $request->file('file') ? $request->file('file')->store('submissions') : null;

        // Créer ou mettre à jour la soumission de l'étudiant
        StudentSubmission::updateOrCreate(
            ['assignment_id' => $assignmentId, 'student_id' => auth()->id()],
            ['response' => $request->response, 'file' => $filePath, 'submitted_at' => now()]
        );

        // Mettre à jour le statut de l'assignation
        $studentAssignment->update(['status' => 'submitted']);

        return redirect()->back()->with('success', 'Soumission effectuée avec succès.');
    }


    public function grade(Request $request, $assignmentId, $studentId)
    {
        $request->validate([
            'grade' => 'required|integer|min:0|max:100',
            'badge_points' => 'nullable|integer',
        ]);

        // Trouver l'entrée de l'assignation étudiant
        $studentAssignment = StudentAssignment::where('assignment_id', $assignmentId)
            ->where('student_id', $studentId)
            ->firstOrFail();

        // Mettre à jour la note et les points
        $studentAssignment->update([
            'grade' => $request->grade,
            'badge_points' => $request->badge_points,
            'status' => 'graded',
        ]);

        return redirect()->back()->with('success', 'Note et points attribués avec succès.');
    }

    public function destroy($id)
    {
        $assignment = Assignment::findOrFail($id);

        // Supprimer les relations liées si nécessaire
        StudentAssignment::where('assignment_id', $id)->delete();
        StudentSubmission::where('assignment_id', $id)->delete();

        // Supprimer le devoir
        $assignment->delete();

        return redirect()->route('assignments.index')->with('success', 'Devoir supprimé avec succès.');
    }
}
