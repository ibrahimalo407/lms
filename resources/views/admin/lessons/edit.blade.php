@extends('layouts.admin')

@section('content')
<style>
    body {
        background-color: #f8f9fa; /* Light background for contrast */
        font-family: 'Arial', sans-serif; /* Modern font */
    }

    .card {
        margin-top: 20px;
        border-radius: 15px; /* Rounded corners */
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
    }

    .card-header {
        background-color: #1E40AF; /* Header background color */
        color: #FFFFFF; /* White text */
        padding: 20px; /* Increased padding */
        border-top-left-radius: 15px; /* Rounded corners */
        border-top-right-radius: 15px; /* Rounded corners */
    }

    label {
        color: #1E40AF; /* Consistent label color */
    }

    .form-control {
        border-radius: 10px; /* Rounded input corners */
        transition: border-color 0.3s ease; /* Smooth transition for border */
    }

    .form-control:focus {
        border-color: #1E40AF; /* Blue border on focus */
        box-shadow: 0 0 5px rgba(30, 64, 175, 0.5); /* Focus shadow */
    }

    .invalid-feedback {
        color: #B00020; /* Error message color */
    }

    .button-container {
        display: flex; /* Flexbox for button alignment */
        justify-content: flex-start; /* Align buttons to the left */
        margin-top: 20px; /* Space above buttons */
        gap: 10px; /* Space between buttons */
    }

    .btn {
        border-radius: 10px; /* Rounded button corners */
        padding: 10px 20px; /* Increased padding */
        transition: background-color 0.3s ease, transform 0.2s; /* Smooth transitions */
    }

    .btn-danger {
        background-color: #B00020; /* Custom danger button color */
        color: #FFFFFF; /* White text */
    }

    .btn-danger:hover {
        background-color: #A00018; /* Darker red on hover */
        transform: translateY(-2px); /* Slight lift effect */
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Shadow on hover */
    }
</style>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Edit Lesson</h5>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.lessons.update', $lesson->id) }}" method="POST">
            @csrf
            @method('put')

            <div class="form-group">
                <label for="course_id">Course*</label>
                <select name="course_id" class="form-control">
                    @foreach($courses as $id => $courseName)
                        <option {{ $id == $lesson->course_id ? "selected" : "" }} value="{{ $id }}">{{ $courseName }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="title">Title*</label>
                <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', isset($lesson) ? $lesson->title : '') }}" required>
                @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="slug">Slug*</label>
                <input type="text" id="slug" name="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug', isset($lesson) ? $lesson->slug : '') }}" required>
                @error('slug')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="full_text">Full Text*</label>
                <textarea id="full_text" name="full_text" rows="5" class="form-control @error('full_text') is-invalid @enderror" required>{{ old('full_text', isset($lesson) ? $lesson->full_text : '') }}</textarea>
                @error('full_text')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="short_text">Short Text*</label>
                <textarea id="short_text" name="short_text" rows="5" class="form-control @error('short_text') is-invalid @enderror" required>{{ old('short_text', isset($lesson) ? $lesson->short_text : '') }}</textarea>
                @error('short_text')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="embed_id">Youtube URL*</label>
                <input type="text" id="embed_id" name="embed_id" class="form-control @error('embed_id') is-invalid @enderror" value="{{ old('embed_id', isset($lesson) ? $lesson->embed_id : '') }}" required>
                @error('embed_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="free_lesson">Free Lesson*</label>
                <select name="free_lesson" class="form-control @error('free_lesson') is-invalid @enderror" id="free_lesson">
                    <option value="1" {{ $lesson->free_lesson == 1 ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ $lesson->free_lesson == 0 ? 'selected' : '' }}>No</option>
                </select>
                @error('free_lesson')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="published">Published*</label>
                <select name="published" class="form-control @error('published') is-invalid @enderror" id="published">
                    <option value="1" {{ $lesson->published == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ $lesson->published == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('published')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="button-container">
                <button class="btn btn-danger" type="submit">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection
