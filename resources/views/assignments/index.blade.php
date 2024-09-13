@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1 class="mb-4">Mes Devoirs et Évaluations</h1>

        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('assignments.create') }}" style="background-color: #1E40AF; border-color: #1E40AF;">
                Ajouter
            </a>
        </div>

        <br>

        @if($assignments->isEmpty())
            <div class="alert alert-info">
                Aucun devoir ou évaluation trouvé.
            </div>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Type</th>
                        <th>Date de rendu</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($assignments as $assignment)
                        <tr>
                            <td>{{ $assignment->title }}</td>
                            <td>{{ $assignment->type == 'homework' ? 'Devoir' : 'Évaluation' }}</td>
                            <td>{{ \Carbon\Carbon::parse($assignment->due_date)->format('d/m/Y') }}</td>
                            <td>
                                <a href="{{ route('assignments.show', $assignment->id) }}" class="btn btn-primary">
                                    Voir les détails
                                </a>
                                <a href="{{ route('assignments.submissions', $assignment->id) }}" class="btn btn-warning">
                                    Voir les soumissions
                                </a>
                                
                                <!-- Button to delete the assignment -->
                                <form action="{{ route('assignments.destroy', $assignment->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce devoir ?')">
                                        Supprimer
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
