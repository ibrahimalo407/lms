@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header" style="background-color: #1E40AF; color: #FFFFFF;">
        Create Lesson
    </div>

    <div class="card-body">
        <form action="{{ route('admin.lessons.store') }}" method="POST">
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
                <label for="title" style="color: #1E40AF;">Title*</label>
                <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', isset($lesson) ? $lesson->title : '') }}" required>
                @error('title')
                <span class="invalid-feedback" role="alert" style="color: #B00020;">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="slug" style="color: #1E40AF;">Slug*</label>
                <input type="text" id="slug" name="slug" class="form-control @error('slug') is-invalid @enderror" value="{{ old('slug', isset($lesson) ? $lesson->slug : '') }}" required>
                @error('slug')
                <span class="invalid-feedback" role="alert" style="color: #B00020;">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="full_text" style="color: #1E40AF;">Full Text*</label>
                <textarea id="full_text" name="full_text" rows="5" class="form-control @error('full_text') is-invalid @enderror" required>{{ old('full_text', isset($lesson) ? $lesson->full_text : '') }}</textarea>
                @error('full_text')
                <span class="invalid-feedback" role="alert" style="color: #B00020;">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="short_text" style="color: #1E40AF;">Short Text*</label>
                <textarea id="short_text" name="short_text" rows="5" class="form-control @error('short_text') is-invalid @enderror" required>{{ old('short_text', isset($lesson) ? $lesson->short_text : '') }}</textarea>
                @error('short_text')
                <span class="invalid-feedback" role="alert" style="color: #B00020;">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="embed_id" style="color: #1E40AF;">Youtube URL*</label>
                <input type="text" id="embed_id" name="embed_id" class="form-control @error('embed_id') is-invalid @enderror" value="{{ old('embed_id', isset($lesson) ? $lesson->embed_id : '') }}" required>
                @error('embed_id')
                <span class="invalid-feedback" role="alert" style="color: #B00020;">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="form-group">
                <label for="free_lesson" style="color: #1E40AF;">Free Lesson*</label>
                <select name="free_lesson" class="form-control @error('free_lesson') is-invalid @enderror" id="free_lesson">
                    <option value="1">Yes</option>
                    <option value="0">No</option>
                </select>
                @error('free_lesson')
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
