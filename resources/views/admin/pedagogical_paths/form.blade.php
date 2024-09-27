@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body p-4">
            <h1 class="mb-4 text-primary">{{ isset($pedagogicalPath) ? 'Edit Pedagogical Path' : 'New Pedagogical Path' }}</h1>

            @if ($errors->any())
                <div class="alert alert-danger fade-in">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ isset($pedagogicalPath) ? route('admin.pedagogical-paths.update', $pedagogicalPath->id) : route('admin.pedagogical-paths.store') }}" method="POST" enctype="multipart/form-data" class="form-modern">
                @csrf
                @if(isset($pedagogicalPath))
                    @method('PUT')
                @endif

                <div class="mb-4">
                    <label for="title" class="form-label text-secondary">Title</label>
                    <input type="text" class="form-control border-primary rounded-3 shadow-sm" id="title" name="title" value="{{ isset($pedagogicalPath) ? $pedagogicalPath->title : old('title') }}" required>
                </div>

                <div class="mb-4">
                    <label for="description" class="form-label text-secondary">Description</label>
                    <textarea class="form-control border-primary rounded-3 shadow-sm" id="description" name="description" rows="4" required>{{ isset($pedagogicalPath) ? $pedagogicalPath->description : old('description') }}</textarea>
                </div>

                <div class="mb-4">
                    <label for="courses" class="form-label text-secondary">Courses</label>
                    @foreach($courses as $course)
                        <div class="form-check form-check-modern">
                            <input class="form-check-input shadow-sm" type="checkbox" name="courses[]" value="{{ $course->id }}" id="course{{ $course->id }}" {{ isset($pedagogicalPath) && in_array($course->id, $pedagogicalPath->courses->pluck('id')->toArray()) ? 'checked' : '' }}>
                            <label class="form-check-label text-muted" for="course{{ $course->id }}">
                                {{ $course->title }}
                            </label>
                        </div>
                    @endforeach
                </div>

                <div class="mb-4">
                    <label for="presentation_video" class="form-label text-secondary">Presentation Video</label>
                    <input type="file" class="form-control border-primary rounded-3 shadow-sm" id="presentation_video" name="presentation_video">
                    @if(isset($pedagogicalPath) && $pedagogicalPath->presentation_video)
                        <p class="mt-2">Current video: <a href="{{ Storage::url($pedagogicalPath->presentation_video) }}" target="_blank" class="text-info">View Video</a></p>
                    @endif
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary px-4 py-2 rounded-3 shadow-lg btn-animate">{{ isset($pedagogicalPath) ? 'Update' : 'Create' }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .form-modern .form-control {
        transition: all 0.3s ease;
    }
    
    .form-modern .form-control:focus {
        box-shadow: 0 0 15px rgba(0, 123, 255, 0.4);
        border-color: #007bff;
    }

    .btn-animate {
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .btn-animate:hover {
        background-color: #0069d9;
        transform: translateY(-2px);
    }

    .fade-in {
        animation: fadeIn 0.5s ease-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }
</style>
@endsection
