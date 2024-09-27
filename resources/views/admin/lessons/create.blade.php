@extends('layouts.admin')

@section('content')
<style>
    body {
        background-color: #f8f9fa; /* Light background for better contrast */
        font-family: 'Arial', sans-serif; /* Modern font */
    }

    .card {
        margin-top: 20px;
        border-radius: 15px; /* More rounded corners */
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
        background-color: #ffffff; /* White background */
    }

    .card-header {
        background-color: #1E40AF; /* Dark blue background */
        color: #FFFFFF; /* White text */
        font-size: 1.75rem; /* Larger font size for headers */
        border-top-left-radius: 15px; /* Rounded top corners */
        border-top-right-radius: 15px; /* Rounded top corners */
        padding: 20px; /* Increased padding */
    }

    .form-group label {
        color: #1E40AF; /* Blue color for labels */
        font-weight: bold; /* Bold labels */
        margin-bottom: 8px; /* Space between label and input */
    }

    .form-control {
        border: 1px solid #1E40AF; /* Blue border for inputs */
        transition: border-color 0.3s ease, box-shadow 0.3s ease; /* Smooth transitions */
        border-radius: 10px; /* Rounded input corners */
        padding: 10px; /* Comfortable padding */
    }

    .form-control:focus {
        border-color: #F97316; /* Orange border on focus */
        box-shadow: 0 0 5px rgba(249, 115, 22, 0.5); /* Orange shadow on focus */
    }

    .invalid-feedback {
        color: #B00020; /* Red color for error messages */
        font-size: 0.9rem; /* Smaller font for error messages */
    }

    .btn-danger {
        background-color: #F97316; /* Orange background */
        border: none; /* No border */
        border-radius: 10px; /* Rounded button corners */
        padding: 10px 20px; /* Comfortable button padding */
        font-weight: bold; /* Bold text on button */
        transition: transform 0.2s ease, background-color 0.3s ease; /* Button effects */
    }

    .btn-danger:hover {
        transform: translateY(-3px); /* Lift effect on hover */
        background-color: #e76a00; /* Darker orange on hover */
    }

    /* Icon styles */
    .input-icon {
        position: relative; /* Positioning for icon */
    }

    .input-icon i {
        position: absolute;
        left: 10px; /* Space from left */
        top: 50%;
        transform: translateY(-50%); /* Center vertically */
        color: #1E40AF; /* Icon color */
    }

    .form-control {
        padding-left: 35px; /* Space for icon */
    }
</style>

<div class="card">
    <div class="card-header">
        Create Lesson
    </div>

    <div class="card-body">
        <form action="{{ route('admin.lessons.store') }}" method="POST">
            @csrf

            <div class="form-group input-icon">
                <label for="course_id">Course*</label>
                <select name="course_id" class="form-control @error('course_id') is-invalid @enderror" id="course_id">
                    @foreach($courses as $id => $course)
                    <option value="{{ $id }}">{{ $course }}</option>
                    @endforeach
                </select>
                @error('course_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group input-icon">
                <label for="title">Title*</label>
                <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', isset($lesson) ? $lesson->title : '') }}" required>
                @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group input-icon">
                <label for="slug">Slug*</label>
                <input type="text" id="slug" name="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug', isset($lesson) ? $lesson->slug : '') }}" required>
                @error('slug')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group input-icon">
                <label for="full_text">Full Text*</label>
                <textarea id="full_text" name="full_text" rows="5" class="form-control @error('full_text') is-invalid @enderror" required>{{ old('full_text', isset($lesson) ? $lesson->full_text : '') }}</textarea>
                @error('full_text')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group input-icon">
                <label for="short_text">Short Text*</label>
                <textarea id="short_text" name="short_text" rows="5" class="form-control @error('short_text') is-invalid @enderror" required>{{ old('short_text', isset($lesson) ? $lesson->short_text : '') }}</textarea>
                @error('short_text')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group input-icon">
                <label for="embed_id">Youtube URL*</label>
                <input type="text" id="embed_id" name="embed_id" class="form-control @error('embed_id') is-invalid @enderror" value="{{ old('embed_id', isset($lesson) ? $lesson->embed_id : '') }}" required>
                @error('embed_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group input-icon">
                <label for="free_lesson">Free Lesson*</label>
                <select name="free_lesson" class="form-control @error('free_lesson') is-invalid @enderror" id="free_lesson">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
                @error('free_lesson')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group input-icon">
                <label for="published">Published*</label>
                <select name="published" class="form-control @error('published') is-invalid @enderror" id="published">
                    <option value="1">Active</option>
                    <option value="0">In Active</option>
                </select>
                @error('published')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div>
                <button class="btn btn-danger" type="submit">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection
