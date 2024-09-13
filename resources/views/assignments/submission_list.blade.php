@extends('layouts.app')

@section('content')
    <h1>Soumissions pour le devoir: {{ $assignment->title }}</h1>

    @if(isset($message))
        <p>{{ $message }}</p>
    @endif

    @if($submissions && $submissions->count() > 0)
        <table>
            <thead>
                <tr>
                    <th>Étudiant</th>
                    <th>Réponse</th>
                    <th>Fichier</th>
                    <th>Date de soumission</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($submissions as $submission)
                    <tr>
                        <td>{{ $submission->user->name }}</td>
                        <td>{{ $submission->response_text ?? 'Pas de réponse textuelle' }}</td>
                        <td>
                            @if($submission->response_file)
                                <a href="{{ asset('storage/' . $submission->response_file) }}" target="_blank">Télécharger</a>
                            @else
                                Aucun fichier soumis
                            @endif
                        </td>
                        <td>{{ $submission->created_at->format('d/m/Y H:i') }}</td>
                        <td>
                            <a href="{{ route('assignments.grade', [$assignment->id, $submission->user->id]) }}" class="btn btn-primary">Noter</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Aucune soumission pour ce devoir.</p>
    @endif
@endsection
