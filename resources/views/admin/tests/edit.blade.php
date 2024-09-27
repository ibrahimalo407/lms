@extends('layouts.admin')

@section('content')

<div class="container mt-5">
    <div class="card shadow-sm border-0 rounded-4 animate__animated animate__fadeIn">
        <div class="card-header" style="background-color: #1E40AF; color: #FFFFFF;">
            <h5 class="mb-0">Edit Test</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.tests.update', $test->id) }}" method="POST">
                @csrf
                @method('put')

                <div class="form-group">
                    <label for="course_id" style="color: #1E40AF;">Course*</label>
                    <select name="course_id" class="form-control @error('course_id') is-invalid @enderror" id="course_id">
                        @foreach($courses as $id => $course)
                        <option {{ $id == $test->course_id ? 'selected' : '' }} value="{{ $id }}">{{ $course }}</option>
                        @endforeach
                    </select>
                    @error('course_id')
                    <span class="invalid-feedback" role="alert" style="color: #B00020;">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="lesson_id" style="color: #1E40AF;">Lesson*</label>
                    <select name="lesson_id" class="form-control @error('lesson_id') is-invalid @enderror" id="lesson_id">
                        @foreach($lessons as $id => $lesson)
                        <option {{ $id == $test->lesson_id ? 'selected' : '' }} value="{{ $id }}">{{ $lesson }}</option>
                        @endforeach
                    </select>
                    @error('lesson_id')
                    <span class="invalid-feedback" role="alert" style="color: #B00020;">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="title" style="color: #1E40AF;">Title*</label>
                    <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $test->title) }}" required>
                    @error('title')
                    <span class="invalid-feedback" role="alert" style="color: #B00020;">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="description" style="color: #1E40AF;">Description*</label>
                    <textarea id="description" name="description" rows="5" class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $test->description) }}</textarea>
                    @error('description')
                    <span class="invalid-feedback" role="alert" style="color: #B00020;">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="published" style="color: #1E40AF;">Published*</label>
                    <select name="published" class="form-control @error('published') is-invalid @enderror" id="published">
                        <option value="1" {{ $test->published == 1 ? 'selected' : '' }}>Active</option>
                        <option value="0" {{ $test->published == 0 ? 'selected' : '' }}>Inactive</option>
                    </select>
                    @error('published')
                    <span class="invalid-feedback" role="alert" style="color: #B00020;">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <button class="btn btn-danger d-flex align-items-center" type="submit" style="background-color: #F97316; color: #FFFFFF;">
                        <i style="margin: 5px" class="fas fa-save me-2"></i> Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

<style>
    /* Styles supplémentaires pour le formulaire */
    .form-group {
        margin-bottom: 1.5rem; /* Espacement entre les champs */
    }

    .btn {
        min-width: 120px; /* Largeur minimale pour les boutons */
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1); /* Ombre légère pour les boutons */
        transition: background-color 0.3s, transform 0.2s; /* Effet de transition */
    }

    .btn:hover {
        transform: translateY(-1px); /* Effet de levée au survol */
    }

    /* Styles pour les labels et les messages d'erreur */
    label {
        font-weight: bold;
    }
</style>
