<?php

namespace App\Http\Controllers;

use App\Models\Invitation;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    //

    // Dans le contrôleur de l'invitation

    public function index()
    {
        // Récupérer les invitations de l'utilisateur connecté
        $invitations = auth()->user()->invitations;

        return view('students.invitations', compact('invitations'));
    }

    public function showAssignments()
    {
        $student = auth()->user(); // Assurez-vous que l'utilisateur est authentifié
        $assignments = $student->assignments()
            ->wherePivot('status', '!=', 'completed')
            ->get();

        return view('student.assignments.index', compact('assignments'));
    }

    public function showAssignment($assignmentId)
    {
        $student = auth()->user(); // Assurez-vous que l'utilisateur est authentifié
        $assignment = $student->assignments()->findOrFail($assignmentId);

        return view('student.assignments.show', compact('assignment'));
    }

    public function markAsSeen($id)
    {
        // Trouver l'invitation en fonction de l'ID
        $invitation = auth()->user()->invitations()->findOrFail($id);

        // Marquer l'invitation comme vue
        $invitation->seen = true;
        $invitation->save();

        // Rediriger vers le lien de la réunion
        return redirect($invitation->meeting_link);
    }




    public function showInvitations()
    {
        $invitations = Invitation::where('student_id', auth()->id())->get();
        return view('students.invitations', compact('invitations'));
    }
}
