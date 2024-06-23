@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-body">
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

                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ isset($pedagogicalPath) ? $pedagogicalPath->title : old('title') }}">
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="4">{{ isset($pedagogicalPath) ? $pedagogicalPath->description : old('description') }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="courses" class="form-label">Courses</label>
                    @foreach($courses as $course)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="courses[]" value="{{ $course->id }}" id="course{{ $course->id }}" {{ isset($pedagogicalPath) && in_array($course->id, $pedagogicalPath->courses->pluck('id')->toArray()) ? 'checked' : '' }}>
                            <label class="form-check-label" for="course{{ $course->id }}">
                                {{ $course->title }}
                            </label>
                        </div>
                    @endforeach
                </div>

                <div class="mb-3">
                    <label for="presentation_video" class="form-label">Presentation Video</label>
                    <input type="file" class="form-control" id="presentation_video" name="presentation_video">
                    @if(isset($pedagogicalPath) && $pedagogicalPath->presentation_video)
                        <p class="mt-2">Current video: <a href="{{ Storage::url($pedagogicalPath->presentation_video) }}" target="_blank">View Video</a></p>
                    @endif
                </div>

                <div class="mb-3 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">{{ isset($pedagogicalPath) ? 'Update' : 'Create' }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
