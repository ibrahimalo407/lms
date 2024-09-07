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
        $invitations = auth()->user()->invitations;

        // Marquer les invitations comme vues
        foreach ($invitations as $invitation) {
            $invitation->seen = true; // Marquer comme vue
            $invitation->save(); // Enregistrer la modification
        }

        return view('students.invitations', compact('invitations'));
    }



    public function showInvitations()
    {
        $invitations = Invitation::where('student_id', auth()->id())->get();
        return view('students.invitations', compact('invitations'));
    }
}
