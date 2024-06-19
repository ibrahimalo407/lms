@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">{{ isset($pedagogicalPath) ? 'Edit Pedagogical Path' : 'New Pedagogical Path' }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ isset($pedagogicalPath) ? route('admin.pedagogical-paths.update', $pedagogicalPath->id) : route('admin.pedagogical-paths.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($pedagogicalPath))
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ isset($pedagogicalPath) ? $pedagogicalPath->title : old('title') }}">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description">{{ isset($pedagogicalPath) ? $pedagogicalPath->description : old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label for="courses">Courses</label>
            @foreach($courses as $course)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="courses[]" value="{{ $course->id }}" id="course{{ $course->id }}" {{ isset($pedagogicalPath) && in_array($course->id, $pedagogicalPath->courses->pluck('id')->toArray()) ? 'checked' : '' }}>
                    <label class="form-check-label" for="course{{ $course->id }}">
                        {{ $course->title }}
                    </label>
                </div>
            @endforeach
        </div>

        <div class="form-group">
            <label for="presentation_video">Presentation Video</label>
            <input type="file" class="form-control" id="presentation_video" name="presentation_video">
            @if(isset($pedagogicalPath) && $pedagogicalPath->presentation_video)
                <p>Current video: <a href="{{ Storage::url($pedagogicalPath->presentation_video) }}" target="_blank">View Video</a></p>
            @endif
        </div>

        <button type="submit" class="btn btn-primary">{{ isset($pedagogicalPath) ? 'Update' : 'Create' }}</button>
    </form>
</div>
@endsection
