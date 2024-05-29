@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header" style="background-color: #1E40AF; color: #FFFFFF;">
        <h5 class="mb-0">Edit Lesson</h5>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.lessons.update', $lesson->id) }}" method="POST">
            @csrf
            @method('put')

            <div class="form-group">
                <label for="course_id" style="color: #1E40AF;">Course*</label>
                <select name="course_id" class="form-control">
                    @foreach($courses as $id => $courseName)
                        <option {{ $id == $lesson->course_id ? "selected" : "" }} value="{{ $id }}">{{ $courseName }}</option>
                    @endforeach
                </select>
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
                    <option value="1" {{ $lesson->free_lesson == 1 ? 'selected' : '' }}>Yes</option>
                    <option value="0" {{ $lesson->free_lesson == 0 ? 'selected' : '' }}>No</option>
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
                    <option value="1" {{ $lesson->published == 1 ? 'selected' : '' }}>Active</option>
                    <option value="0" {{ $lesson->published == 0 ? 'selected' : '' }}>Inactive</option>
                </select>
                @error('published')
                <span class="invalid-feedback" role="alert" style="color: #B00020;">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>

            <div class="text-left">
                <button class="btn btn-danger" type="submit" style="background-color: #B00020; color: #FFFFFF;">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection
