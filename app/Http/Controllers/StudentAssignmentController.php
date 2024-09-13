<?php

namespace App\Http\Controllers;

use App\Models\Assignment;
use Illuminate\Http\Request;
use App\Models\StudentAssignment;
use App\Models\StudentSubmission;
use App\Models\AssignmentResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class StudentAssignmentController extends Controller
{
    public function index()
    {
        $student = auth()->user();

        // Récupérer les devoirs auxquels l'étudiant n'a pas encore répondu
        $assignments = Assignment::whereHas('students', function ($query) use ($student) {
            $query->where('student_id', $student->id)
                ->where('status', '!=', 'submitted');
        })->get();

        return view('student.assignments.index', compact('assignments'));
    }




    public function show($id)
    {
        $assignment = Assignment::findOrFail($id);
        return view('student.assignments.show', compact('assignment'));
    }

    public function submit(Request $request, $id)
    {
        // Valider la requête pour s'assurer que les données sont correctes
        $request->validate([
            'response_text' => 'nullable|string',
            'response_file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $student = auth()->user();  // Récupère l'utilisateur authentifié
        $assignment = Assignment::findOrFail($id);  // Trouve l'assignation

        // Vérifie si un fichier est soumis et le sauvegarde
          $filePath = null;
        if ($request->hasFile('response_file')) {
            $file = $request->file('response_file');
            $fileName = 'submission_' . $student->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $filePath = $file->storeAs('submissions', $fileName);  // Sauvegarde le fichier
        }

        // Enregistre ou met à jour la réponse de l'étudiant dans `assignment_responses`
        AssignmentResponse::create([
            'assignment_id' => $assignment->id,
            'user_id' => $student->id,
            'response_text' => $request->input('response_text'),
            'response_file' => $filePath,
        ]);
        
        // Met à jour le statut de l'assignation de l'étudiant comme "soumis"
        StudentAssignment::where('assignment_id', $assignment->id)
            ->where('student_id', $student->id)
            ->update(['status' => 'submitted']);

        // Redirige l'étudiant après la soumission
        return redirect()->route('student.assignments')->with('success', 'Votre réponse a été soumise.');
    }
 



    public function showPendingAssignments()
    {
        $student = auth()->user();

        $assignments = StudentAssignment::where('student_id', $student->id)
            ->where('status', 'assigned') // Assurez-vous que seuls les devoirs non soumis sont récupérés
            ->get();

        return view('student.assignments', compact('assignments'));
    }
}
