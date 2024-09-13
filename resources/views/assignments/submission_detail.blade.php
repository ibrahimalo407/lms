@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Soumission de {{ $submission->user->name }} pour le devoir: {{ $assignment->title }}</h1>

        <div class="submission-details">
            <h3>Réponse de l'étudiant :</h3>
            <p>{{ $submission->response_text ?? 'Aucun texte soumis' }}</p>

            <h3>Fichier soumis :</h3>
            @if($submission->response_file)
                <a href="{{ asset('storage/' . $submission->response_file) }}" target="_blank">Télécharger le fichier</a>
            @else
                <p>Aucun fichier soumis</p>
            @endif

            <form action="{{ route('assignments.submit_grade', ['assignment_id' => $assignment->id, 'student_id' => $submission->user_id]) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="grade">Note</label>
                    <input type="number" name="grade" id="grade" class="form-control" value="{{ old('grade') ?? $submission->grade }}">
                </div>

                <button type="submit" class="btn btn-success">Soumettre la note</button>
            </form>
        </div>
    </div>
@endsection
