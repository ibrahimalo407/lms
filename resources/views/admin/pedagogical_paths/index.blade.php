@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="text-primary">Pedagogical Paths</h1>
        <a href="{{ route('admin.pedagogical-paths.create') }}" class="btn btn-primary btn-lg shadow-lg">
            <i class="fas fa-plus"></i> New Pedagogical Path
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        @foreach ($pedagogicalPaths as $path)
            <div class="col-md-6 mb-4">
                <div class="card shadow-sm h-100 border-0 rounded" style="transition: transform 0.3s ease, box-shadow 0.3s ease; animation: fadeIn 0.5s;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title text-primary">{{ $path->title }}</h5>
                        <p class="card-text text-muted text-truncate">{{ Str::limit($path->description, 100) }}</p>
                        @if (Str::length($path->description) > 100)
                            <a href="#" class="text-info" data-bs-toggle="tooltip" data-bs-placement="top" title="{{ $path->description }}">Read more</a>
                        @endif

                        @if($path->presentation_video)
                            <div class="embed-responsive embed-responsive-16by9 my-3">
                                <video class="embed-responsive-item" controls>
                                    <source src="{{ $path->presentation_video_url }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            </div>
                        @endif

                        <div class="mb-2">
                            <strong class="text-primary">Courses:</strong>
                            <ul class="list-unstyled mt-2">
                                @foreach ($path->courses as $course)
                                    <li><span class="badge bg-primary">{{ $course->title }}</span></li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="mt-auto d-flex justify-content-between">
                            <a href="{{ route('admin.pedagogical-paths.edit', $path->id) }}" class="btn btn-outline-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.pedagogical-paths.destroy', $path->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                    <i class="fas fa-trash-alt"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-end mt-4">
        <a href="{{ route('admin.pedagogical-paths.create') }}" class="btn btn-primary btn-lg rounded-circle shadow-lg position-fixed" style="bottom: 20px; right: 20px; transition: transform 0.3s ease;">
            <i class="fas fa-plus"></i>
        </a>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card:hover {
        transform: translateY(-10px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    .btn:hover {
        transform: scale(1.05);
    }

    .btn-outline-primary:hover, .btn-outline-danger:hover {
        background-color: #0056b3;
        color: white;
    }
</style>
@endpush

@push('scripts')
<script>
    // Enable Bootstrap tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
</script>
@endpush
