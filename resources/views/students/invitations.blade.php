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
        <p class="lead text-muted">Voici la liste des invitations à vos réunions. Cliquez sur le lien pour accéder à la réunion.</p>
    </div>

    <!-- Affichage si aucune invitation n'est présente -->
    @if($invitations->isEmpty())
        <div class="alert alert-info text-center">
            <i class="fas fa-info-circle"></i> Vous n'avez aucune invitation pour le moment.
        </div>
    @else
        <!-- Tableau des invitations stylisé occupant toute la largeur -->
        <div class="table-responsive shadow-lg">
            <table class="table table-hover custom-table">
                <thead>
                    <tr class="table-primary">
                        <th>Réunion</th>
                        <th>Lien</th>
                        <th class="text-center">Statut</th>
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
    body {
        font-family: 'Poppins', sans-serif; /* Ensure consistent font */
        background-color: #121212; /* Dark background for the page */
        color: #ffffff; /* Default text color */
    }

    .custom-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0 10px;
    }

    .custom-table thead th {
        background-color: #007bff; /* Bootstrap primary color */
        color: white;
        text-align: center;
        padding: 15px;
        border-radius: 10px 10px 0 0;
    }

    .custom-table tbody td {
        padding: 20px;
        vertical-align: middle;
        background-color: #ffffff; /* White background for rows */
        border-bottom: 1px solid #e9ecef; /* Light border */
        border-radius: 8px; /* Rounded corners */
    }

    .custom-table tbody tr:hover td {
        background-color: #f1f1f1; /* Light gray on hover */
        transition: background-color 0.3s ease;
    }

    .custom-link {
        color: #007bff; /* Bootstrap primary color */
        font-weight: bold;
        text-decoration: none;
    }

    .custom-link:hover {
        color: #0056b3; /* Darker blue on hover */
        text-decoration: underline;
    }

    .badge-warning {
        background-color: #ffc107; /* Bootstrap warning color */
        color: white;
        padding: 5px;
        border-radius: 5px;
        
    }

    .badge-success {
        background-color: #28a745; /* Bootstrap success color */
        color: white;
        padding: 5px 10px; /* Added padding for better visibility */
        border-radius: 5px; /* Rounded corners */
    }

    .table-responsive {
        padding: 20px;
    }

    /* Additional styling for the alert */
    .alert {
        border-radius: 10px; /* Rounded corners for alerts */
        margin-top: 20px; /* Spacing above the alert */
    }
</style>
