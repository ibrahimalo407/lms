@extends('layouts.admin')

@section('content')
<div class="card shadow-lg rounded">
    <div class="card-header" style="background-color: #1E40AF; color: #FFFFFF;">
        <h5 class="mb-0">Edit Course</h5>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.courses.update', $course->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('put')

            <div class="form-group">
                <label for="title" style="color: #1E40AF;">Title*</label>
                <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', isset($course) ? $course->title : '') }}" required>
                @error('title')
                <span class="invalid-feedback" role="alert" style="color: #B00020;">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="slug" style="color: #1E40AF;">Slug*</label>
                <input type="text" id="slug" name="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug', isset($course) ? $course->slug : '') }}" required>
                @error('slug')
                <span class="invalid-feedback" role="alert" style="color: #B00020;">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="description" style="color: #1E40AF;">Description*</label>
                <textarea id="description" name="description" rows="5" class="form-control @error('description') is-invalid @enderror" required>{{ old('description', isset($course) ? $course->description : '') }}</textarea>
                @error('description')
                <span class="invalid-feedback" role="alert" style="color: #B00020;">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="price" style="color: #1E40AF;">Price*</label>
                <input type="number" id="price" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', isset($course) ? $course->price : '') }}" required>
                @error('price')
                <span class="invalid-feedback" role="alert" style="color: #B00020;">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="course_image" style="color: #1E40AF;">Course Image</label>
                <input type="file" id="course_image" name="course_image" class="form-control @error('course_image') is-invalid @enderror">
                @error('course_image')
                <span class="invalid-feedback" role="alert" style="color: #B00020;">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="start_date" style="color: #1E40AF;">Start Date*</label>
                <input type="date" id="start_date" name="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date', isset($course) ? $course->start_date : '') }}" required>
                @error('start_date')
                <span class="invalid-feedback" role="alert" style="color: #B00020;">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="published" style="color: #1E40AF;">Published*</label>
                <select name="published" class="form-control @error('published') is-invalid @enderror" id="published">
                    <option value="1" {{ $course->published == 'Active' ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ $course->published == 'Inactive' ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('published')
                <span class="invalid-feedback" role="alert" style="color: #B00020;">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="d-flex justify-content-between">
                <button class="btn btn-danger" type="submit" style="background-color: #B00020; color: #FFFFFF; border-radius: 25px; transition: background-color 0.3s;">Save</button>
                <a href="{{ route('admin.courses.index') }}" class="btn btn-secondary" style="border-radius: 25px; transition: background-color 0.3s;">Cancel</a>
            </div>
        </form>
    </div>
</div>

<style>
    .card {
        border-radius: 15px;
        margin: 20px 0;
    }

    .form-group label {
        font-weight: 600;
    }

    .btn {
        transition: transform 0.2s;
    }

    .btn:hover {
        transform: scale(1.05);
    }
</style>
@endsection
