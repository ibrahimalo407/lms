@extends('layouts.front')

@section('content')
    <h1>Soumettre votre devoir pour : {{ $assignment->title }}</h1>

    <form action="{{ route('assignments.submit.store', $assignment->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="submission_text">Votre réponse (texte)</label>
            <textarea name="submission_text" class="form-control" rows="5">{{ old('submission_text') }}</textarea>
        </div>

        <div class="form-group">
            <label for="submission_file">Votre fichier (PDF ou Word)</label>
            <input type="file" name="submission_file" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Soumettre</button>
    </form>
@endsection
