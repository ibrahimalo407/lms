@extends('layouts.admin')

@section('content')
<div class="card shadow-lg rounded" style="border: none;">
    <div class="card-header bg-gradient text-white d-flex align-items-center">
        <i class="fas fa-edit fa-lg mr-2"></i>
        <h5 class="mb-0">Edit Course</h5>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')

            @if(auth()->user()->isAdmin())
            <div class="form-group">
                <label for="teacher" class="text-primary">Teachers*</label>
                <select name="teachers[]" class="form-control @error('teachers') is-invalid @enderror" id="teacher" multiple>
                    @foreach($teachers as $id => $teacher)
                    <option value="{{ $id }}" {{ in_array($id, old('teachers', $course->teachers->pluck('id')->toArray())) ? 'selected' : '' }}>{{ $teacher }}</option>
                    @endforeach
                </select>
                @error('teachers')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            @endif
            
            <div class="form-group">
                <label for="title" class="text-primary">Title*</label>
                <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', isset($course) ? $course->title : '') }}" required>
                @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="slug" class="text-primary">Slug*</label>
                <input type="text" id="slug" name="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug', isset($course) ? $course->slug : '') }}" required>
                @error('slug')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="description" class="text-primary">Description*</label>
                <textarea id="description" name="description" rows="5" class="form-control @error('description') is-invalid @enderror" required>{{ old('description', isset($course) ? $course->description : '') }}</textarea>
                @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="price" class="text-primary">Price*</label>
                <input type="number" id="price" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', isset($course) ? $course->price : '') }}" required>
                @error('price')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="course_image" class="text-primary">Course Image*</label>
                <input type="file" id="course_image" name="course_image" class="form-control @error('course_image') is-invalid @enderror">
                @error('course_image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="start_date" class="text-primary">Start Date*</label>
                <input type="date" id="start_date" name="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date', isset($course) ? $course->start_date : '') }}" required>
                @error('start_date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="published" class="text-primary">Published*</label>
                <select name="published" class="form-control @error('published') is-invalid @enderror" id="published">
                    <option value="1" {{ (old('published', isset($course) ? $course->published : 1) == 1) ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ (old('published', isset($course) ? $course->published : 0) == 0) ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('published')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <button class="btn btn-warning btn-block" style="background-color: #FFA000; color: #FFFFFF; transition: background-color 0.3s; border-radius: 25px;" type="submit">
                    <i class="fas fa-save mr-1"></i> Save
                </button>
            </div>
        </form>
    </div>
</div>

<style>
    .bg-gradient {
        background: linear-gradient(to right, #007bff, #0d6efd);
    }

    .card {
        border-radius: 15px;
        margin: 20px 0;
    }

    .form-control {
        border: 1px solid #0d6efd;
        transition: border-color 0.3s, box-shadow 0.3s;
        border-radius: 10px;
        padding: 10px;
    }

    .form-control:focus {
        border-color: #0056b3;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    .btn-warning {
        border-radius: 25px;
    }

    .btn-warning:hover {
        background-color: #ff8f00;
    }

    .text-primary {
        font-weight: bold;
        font-size: 1rem;
    }

    .invalid-feedback {
        font-size: 0.875rem;
    }

    .mr-2 {
        margin-right: 0.5rem;
    }

    .mr-1 {
        margin-right: 0.25rem;
    }
</style>
@endsection
