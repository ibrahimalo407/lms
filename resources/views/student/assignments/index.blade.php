@extends('layouts.front')

<br>
<br>
<br>
<br>
<br>
@section('content')
    <div class="container py-5">
        <!-- Titre Principal -->
        <h1 class="text-center mb-5" style="font-family: 'Poppins', sans-serif; font-weight: 700; color: #00698f;">
            📚 Mes Devoirs Non Complétés
        </h1>

        <!-- Vérification si des devoirs existent -->
        @if($assignments->isEmpty())
            <p class="text-center" style="font-size: 1.2rem; color: #888;">
                <i class="fas fa-check-circle" style="color: #00698f;"></i> Aucun devoir en attente.
            </p>
        @else
            <!-- Grille de Cartes avec Espacement -->
            <div class="row g-4">
                @foreach($assignments as $assignment)
                    <div class="col-md-6 col-lg-4 d-flex">
                        <div class="card h-100 shadow-lg custom-card">
                            <div class="card-body d-flex flex-column justify-content-between">
                                <div>
                                    <!-- Titre du devoir -->
                                    <h3 class="card-title" style="font-family: 'Poppins', sans-serif; font-weight: 600; color: #333;">
                                        {{ $assignment->title }}
                                    </h3>
                                    <!-- Date limite -->
                                    <p class="card-text" style="color: #555;">
                                        Date limite : 
                                        <span class="badge bg-warning text-dark">
                                            {{ \Carbon\Carbon::parse($assignment->due_date)->format('d/m/Y') }}
                                        </span>
                                    </p>
                                    <BR></BR>
                                </div>
                                <!-- Bouton pour voir le devoir -->
                                <div class="mt-3">
                                    <a href="{{ route('student.assignments.show', $assignment->id) }}" 
                                       class="btn btn-primary w-100 custom-btn">
                                       Voir le devoir <i class="fas fa-arrow-right ms-2"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <br>
                    </div>
                @endforeach
            </div>
        @endif
    </div>

    <!-- CSS intégré pour styliser la page et optimiser l'espacement -->
    <style>
        /* Police moderne pour toute la page */
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7f9;
        }

        /* Espacement entre les cartes */
        .row.g-4 {
            row-gap: 2rem; /* Espace vertical entre les lignes */
            column-gap: 2rem; /* Espace horizontal entre les colonnes */
        }

        /* Style des cartes */
        .custom-card {
            border-radius: 15px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            background-color: white;
            padding: 20px;
        }

        /* Espacement interne des cartes */
        .custom-card .card-body {
            padding: 15px;
        }

        /* Effet au survol des cartes */
        .custom-card:hover {
            transform: scale(1.05);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.2);
        }

        /* Bouton stylisé */
        .custom-btn {
            background-color: #ffcf24;
            border: none;
            border-radius: 10px;
            transition: background-color 0.3s ease;
            font-weight: 600;
        }

        /* Effet au survol du bouton */
        .custom-btn:hover {
            background-color: #00698f;
        }

        /* Style pour le titre principal */
        h1 {
            font-size: 2.5rem;
            margin-bottom: 30px;
        }

        /* Grille responsive */
        @media (max-width: 768px) {
            h1 {
                font-size: 2rem;
            }

            .custom-card {
                margin-bottom: 20px;
            }
        }

        /* Espacement supplémentaire pour les petites cartes */
        @media (max-width: 576px) {
            .custom-card {
                margin-bottom: 1.5rem;
            }
        }
    </style>
@endsection
