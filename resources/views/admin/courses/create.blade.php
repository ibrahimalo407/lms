@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header" style="background-color: #0d6efd; color: #FFFFFF;">
        Create Course
    </div>
    <div class="card-body">
        <form action="{{ route('admin.courses.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(auth()->user()->isAdmin())
            <div class="form-group">
                <label for="teacher" style="color: #0d6efd;">Teachers*</label>
                <select name="teachers[]" class="form-control @error('teachers') is-invalid @enderror" id="teacher" multiple>
                    @foreach($teachers as $id => $teacher)
                    <option value="{{ $id }}">{{ $teacher }}</option>
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
                <label for="title" style="color: #0d6efd;">Title*</label>
                <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', isset($course) ? $course->title : '') }}" required>
                @error('title')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="slug" style="color: #0d6efd;">Slug*</label>
                <input type="text" id="slug" name="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug', isset($course) ? $course->slug : '') }}" required>
                @error('slug')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="description" style="color: #0d6efd;">Description*</label>
                <textarea id="description" name="description" rows="5" class="form-control @error('description') is-invalid @enderror" required>{{ old('description', isset($course) ? $course->description : '') }}</textarea>
                @error('description')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="price" style="color: #0d6efd;">Price*</label>
                <input type="number" id="price" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', isset($course) ? $course->price : '') }}" required>
                @error('price')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="course_image" style="color: #0d6efd;">Course Image*</label>
                <input type="file" id="course_image" name="course_image" class="form-control @error('course_image') is-invalid @enderror" required>
                @error('course_image')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="start_date" style="color: #0d6efd;">Start Date*</label>
                <input type="date" id="start_date" name="start_date" class="form-control @error('start_date') is-invalid @enderror" value="{{ old('start_date', isset($course) ? $course->start_date : '') }}" required>
                @error('start_date')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <label for="published" style="color: #0d6efd;">Published*</label>
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
            <div class="form-group">
                <button class="btn btn-warning" style="background-color: #FFA000; color: #FFFFFF" type="submit">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection