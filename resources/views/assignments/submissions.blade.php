@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Soumissions pour le devoir: {{ $assignment->title }}</h1>

        @if($submissions->isEmpty())
            <p>Aucune soumission pour ce devoir.</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Étudiant</th>
                        <th>Réponse</th>
                        <th>Fichier</th>
                        <th>Date de soumission</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($submissions as $submission)
                        <tr>
                            <td>{{ $submission->user->name }}</td>
                            <td>{{ $submission->response_text ?? 'Aucun texte soumis' }}</td>
                            <td>
                                @if($submission->response_file)
                                    <a href="{{ asset('storage/' . $submission->response_file) }}" target="_blank">Télécharger le fichier</a>
                                @else
                                    Aucun fichier soumis
                                @endif
                            </td>
                            <td>{{ $submission->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <!-- Ajouter un bouton pour noter ou commenter la soumission -->
                                <a href="#" class="btn btn-primary">Noter</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
