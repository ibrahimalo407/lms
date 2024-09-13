<?php

namespace App\Http\Controllers;

use App\Models\StudentAssignment;
use Illuminate\Http\Request;

class GradeController extends Controller
{

    public function index()
    {
        // Logique pour récupérer les notes des étudiants
        $grades = auth()->user()->grades; // Récupérer les notes de l'utilisateur connecté

        return view('student.grades.index', compact('grades'));
    }
    // Afficher la page pour noter les soumissions
    public function edit($studentAssignmentId)
    {
        $studentAssignment = StudentAssignment::with('student', 'assignment')->findOrFail($studentAssignmentId);
        return view('grades.edit', compact('studentAssignment'));
    }

    // Sauvegarder la note
    public function update(Request $request, $studentAssignmentId)
    {
        $validatedData = $request->validate([
            'grade' => 'required|numeric|min:0|max:20',
            'badge_points' => 'nullable|numeric|min:0',
        ]);

        $studentAssignment = StudentAssignment::findOrFail($studentAssignmentId);
        $studentAssignment->update($validatedData);

        return redirect()->route('assignments.show', $studentAssignment->assignment_id)->with('success', 'Note attribuée avec succès.');
    }
}
