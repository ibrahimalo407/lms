@extends('layouts.front')


<br>
<br>
<br>
<br>
<br>

@section('content')
<div class="container-fluid mt-5">
    <!-- Section d'introduction -->
    <div class="text-center mb-5">
        <h1 class="display-4 text-primary">Mes Invitations</h1>
        <br>
        <p class="lead text-muted">Voici la liste des invitations à vos réunions. Cliquez sur le lien pour accéder à la réunion.</p>
    </div>

    <br>
    <!-- Affichage si aucune invitation n'est présente -->
    @if($invitations->isEmpty())
        <div class="alert alert-info text-center">
            <i class="fas fa-info-circle"></i> Vous n'avez aucune invitation pour le moment.
        </div>
    @else
        <!-- Tableau des invitations stylisé occupant toute la largeur -->
        <div class="table-responsive">
            <table class="table table-hover custom-table shadow-lg w-100">
                <thead>
                    <tr class="table-primary">
                        <th>Réunion</th>
                        <th>Lien</th>
                        <th>Statut</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($invitations as $invitation)
                        <tr>
                            <!-- Nom de la réunion -->
                            <td>
                                <i class="fas fa-calendar-alt text-primary"></i> {{ $invitation->meeting->roomName }}
                            </td>
                            <!-- Lien vers la réunion -->
                            <td>
                                <a href="{{ $invitation->meeting_link }}" class="custom-link" target="_blank">
                                    <i class="fas fa-link"></i> {{ $invitation->meeting_link }}
                                </a>
                            </td>
                            <!-- Statut (Vue ou Non Vue) -->
                            <td class="text-center">
                                @if(!$invitation->seen)
                                    <span class="badge badge-warning">
                                        <i class="fas fa-eye-slash"></i> Non Vue
                                    </span>
                                @else
                                    <span class="badge badge-success">
                                        <i class="fas fa-eye"></i> Vue
                                    </span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
</div>
@endsection

<!-- Styles personnalisés pour le tableau -->
<style>
    .custom-table {
        border-collapse: collapse;
        width: 100%;
    }

    .custom-table thead th {
        background-color: #007bff;
        color: white;
        text-align: center;
        padding: 15px;
    }

    .custom-table tbody td {
        padding: 20px;
        vertical-align: middle;
        border: 1px solid #dee2e6;
        background-color: #f9f9f9;
    }

    .custom-table tbody tr:hover td {
        background-color: #f1f1f1;
        transition: all 0.2s ease;
    }

    .custom-link {
        color: #007bff;
        font-weight: bold;
        text-decoration: none;
    }

    .custom-link:hover {
        color: #0056b3;
        text-decoration: underline;
    }

    .badge-warning {
        background-color: #ffc107;
        color: white;
    }

    .badge-success {
        background-color: #28a745;
        color: white;
    }

    .table-responsive {
        overflow-x: auto;
    }

</style>
