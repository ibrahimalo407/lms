@extends('layouts.front')

<br>
<br>
<br>
<br>
<br>

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="assignment-detail-container">
        <h1 class="assignment-title">{{ $assignment->title }}</h1>
        <p class="assignment-description">{{ $assignment->description }}</p>

        <form action="{{ route('student.assignments.submit', $assignment->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="response_text">Réponse</label>
                <textarea id="response_text" name="response_text" class="form-control">{{ old('response_text') }}</textarea>
            </div>
            <div class="form-group">
                <label for="response_file">Fichier de réponse</label>
                <input type="file" id="response_file" name="response_file" class="form-control">
            </div>
            <button type="submit" class="btn-submit">Soumettre</button>
        </form>
    </div>
@endsection

<style>
    .assignment-detail-container {
        padding: 20px;
        max-width: 800px;
        margin: 0 auto;
    }

    .assignment-title {
        font-size: 2rem;
        margin-bottom: 10px;
    }

    .assignment-description {
        font-size: 1.2rem;
        margin-bottom: 20px;
    }

    .assignment-form {
        display: flex;
        flex-direction: column;
    }

    .form-group {
        margin-bottom: 15px;
    }

    .form-control {
        width: 100%;
        padding: 10px;
        border: 1px solid #ced4da;
        border-radius: 4px;
    }

    .btn-submit {
        background-color: #007bff;
        color: #008cc9;
        border: none;
        padding: 10px 20px;
        border-radius: 4px;
        cursor: pointer;
        font-size: 1rem;
        font-weight: bold;
    }

    .btn-submit:hover {
        background-color: #d6d6d6;
    }
</style>
