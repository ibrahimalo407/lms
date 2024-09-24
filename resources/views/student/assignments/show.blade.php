@extends('layouts.front')
<br>
<br>
<br>
<br>
<br>
@section('content')
    <div class="container py-5">
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="assignment-detail-container shadow-sm p-5 rounded bg-white">
            <!-- Titre de l'assignation -->
            <h1 class="assignment-title mb-4 text-primary">{{ $assignment->title }}</h1>
            <p class="assignment-description text-muted">{{ $assignment->description }}</p>

            <!-- Formulaire de soumission -->
            <form action="{{ route('student.assignments.submit', $assignment->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <!-- Réponse texte -->
                <div class="form-group mb-4">
                    <label for="response_text" class="form-label text-secondary">Votre réponse</label>
                    <textarea id="response_text" name="response_text" class="form-control textarea form-control-lg" rows="6" placeholder="Rédigez votre réponse ici...">{{ old('response_text') }}</textarea>
                </div>

                <br>    
                <!-- Fichier de réponse -->
                <div class="form-group mb-4">
                    <label for="response_file" class="form-label text-secondary">Fichier de réponse</label>
                    <input type="file" id="response_file" name="response_file" class="form-control form-control-lg">
                </div>
                <br>
                <!-- Bouton de soumission -->
                <div class="btn">
                    <button type="submit" class="btn btn-lg w-100">Soumettre le devoir</button>
                </div>
            </form>
        </div>
    </div>
@endsection

<style>
    /* Conteneur global */
    body {
        background-color: #f0f2f5; /* Couleur d'arrière-plan douce */
    }

    .assignment-detail-container {
        background-color: #fff;
        border-radius: 12px;
        max-width: 900px;
        margin: 0 auto;
        padding: 40px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05); /* Ombre douce pour donner de la profondeur */
    }

    .textarea{
        width: 100%;
    }

    /* Titre de l'assignation */
    .assignment-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #007bff; /* Bleu moderne */
    }

    /* Description de l'assignation */
    .assignment-description {
        font-size: 1.2rem;
        margin-bottom: 30px;
        color: #6c757d;
    }

    /* Champ de formulaire */
    .form-control {
        padding: 12px;
        font-size: 1.1rem;
        border-radius: 8px;
        border: 1px solid #ced4da;
        background-color: #f8f9fa; /* Légère couleur de fond pour plus de contraste */
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    .form-control:focus {
        border-color: #007bff;
        box-shadow: 0 0 10px rgba(0, 123, 255, 0.2);
    }

    /* Bouton de soumission */
    .btn{
        background-color: #ffffff;
        border: none;
        border-radius: 8px;
        color: #007bff;
        text-align: center;
        font-size: 1.2rem;
        font-weight: bold;
        padding: 12px 20px;
        transition: background-color 0.3s ease, transform 0.2s;
    }

    .btn:hover {
        background-color: #0056b3;
        transform: scale(1.02); /* Légère animation de survol */
    }

    /* Alertes */
    .alert {
        font-size: 1rem;
        margin-bottom: 30px;
    }

    /* Conteneur responsive */
    @media (max-width: 768px) {
        .assignment-title {
            font-size: 2rem;
        }

        .assignment-detail-container {
            padding: 20px;
        }

        .form-control {
            font-size: 1rem;
        }

        .btn-primary {
            font-size: 1rem;
        }
    }

    @media (max-width: 576px) {
        .assignment-title {
            font-size: 1.8rem;
        }

        .assignment-detail-container {
            padding: 15px;
        }
    }
</style>
