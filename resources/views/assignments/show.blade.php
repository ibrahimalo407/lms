@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>{{ $assignment->title }}</h1>

        <p>{{ $assignment->description }}</p>
        <p><strong>Date limite :</strong> {{ $assignment->due_date->format('d/m/Y') }}</p>

        <hr>

        @if (Auth::user()->hasRole('student'))
            <h3>Soumettre votre travail</h3>

            <form action="{{ route('assignments.submit', $assignment->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="response_text">Réponse texte</label>
                    <textarea class="form-control" name="response_text" id="response_text" rows="4"></textarea>
                </div>
                <div class="form-group">
                    <label for="file">Soumettre un fichier</label>
                    <input type="file" class="form-control" name="file" id="file">
                </div>
                <button type="submit" class="btn btn-success">Soumettre</button>
            </form>

            <hr>

            <h3>Devoirs à rendre</h3>
            @if ($assignments->count())
                <ul>
                    @foreach ($assignments as $assignment)
                        @if (
                            $assignment->due_date > now() &&
                                !Auth::user()->submissions->where('assignment_id', $assignment->id)->first())
                            <li>{{ $assignment->title }} - {{ $assignment->due_date->format('d/m/Y') }}</li>
                        @endif
                    @endforeach
                </ul>
            @else
                <p>Aucun devoir à rendre pour le moment.</p>
            @endif
        @endif

        <h3>Groupes Assignés</h3>
        <ul>
            @foreach ($assignment->groups as $group)
                <li>{{ $group->name }}</li>
            @endforeach
        </ul>


        
        @if (Auth::user()->hasRole('teacher') || Auth::user()->hasRole('admin'))
            <h3>Noter les travaux des étudiants</h3>

            <form action="{{ route('assignments.grade', $assignment->id) }}" method="POST">
                @csrf
                <table class="table">
                    <thead>
                        <tr>
                            <th>Étudiant</th>
                            <th>Note</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($assignment->students as $student)
                            <tr>
                                <td>{{ $student->name }}</td>
                                <td>
                                    <input type="number" name="grades[{{ $student->id }}]" class="form-control"
                                        min="0" max="100" value="{{ $student->pivot->grade ?? '' }}">
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <button type="submit" class="btn btn-primary">Enregistrer les notes</button>
            </form>
        @endif
    </div>
@endsection
