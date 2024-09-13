<?php

namespace App\Http\Controllers;

use App\Models\StudentAssignment;
use App\Models\StudentSubmission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentSubmissionController extends Controller
{
    // Afficher le formulaire de soumission
    public function create($assignmentId)
    {
        $studentAssignment = StudentAssignment::where('assignment_id', $assignmentId)
            ->where('student_id', auth()->id())
            ->firstOrFail();

        return view('submissions.create', compact('studentAssignment'));
    }

    // Sauvegarder la soumission
    public function store(Request $request, $assignmentId)
    {
        $validatedData = $request->validate([
            'submission_text' => 'nullable|string',
            'submission_file' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $studentAssignment = StudentAssignment::where('assignment_id', $assignmentId)
            ->where('student_id', auth()->id())
            ->firstOrFail();

        // Gérer la soumission du fichier
        if ($request->hasFile('submission_file')) {
            $filePath = $request->file('submission_file')->store('submissions');
            $validatedData['submission_file'] = $filePath;
        }

        $validatedData['submitted_at'] = now();
        $studentAssignment->submissions()->create($validatedData);

        // Mettre à jour le statut de l'affectation
        $studentAssignment->update(['status' => 'submitted']);

        return redirect()->route('assignments.show', $assignmentId)->with('success', 'Soumission envoyée avec succès.');
    }
}
