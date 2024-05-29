@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header" style="background-color: #1E40AF; color: #FFFFFF;">
        <h5 class="mb-0">Create Test</h5>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.tests.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="course_id" style="color: #1E40AF;">Course*</label>
                <select name="course_id" class="form-control @error('course_id') is-invalid @enderror" id="course_id">
                    @foreach($courses as $id => $course)
                    <option value="{{ $id }}">{{ $course }}</option>
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
                    <option value="{{ $id }}">{{ $lesson }}</option>
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
                <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                @error('title')
                <span class="invalid-feedback" role="alert" style="color: #B00020;">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="description" style="color: #1E40AF;">Description*</label>
                <textarea id="description" name="description" rows="5" class="form-control @error('description') is-invalid @enderror" required>{{ old('description') }}</textarea>
                @error('description')
                <span class="invalid-feedback" role="alert" style="color: #B00020;">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="published" style="color: #1E40AF;">Published*</label>
                <select name="published" class="form-control @error('published') is-invalid @enderror" id="published">
                    <option value="1">Active</option>
                    <option value="0">In Active</option>
                </select>
                @error('published')
                <span class="invalid-feedback" role="alert" style="color: #B00020;">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div>
                <button class="btn btn-danger" type="submit" style="background-color: #F97316; color: #FFFFFF;">Save</button>
            </div>
        </form>
    </div>
</div>

@endsection
