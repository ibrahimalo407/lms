@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h1 class="mb-0">Edit Group</h1>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <form action="{{ route('admin.groups.update', $group->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $group->name) }}">
                </div>

                <div class="mb-3">
                    <label for="students" class="form-label">Students</label>
                    <div class="card">
                        <div class="card-body">
                            @foreach ($students as $student)
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="student_{{ $student->id }}" name="students[]" value="{{ $student->id }}"
                                        @if ($group->users && $group->users->pluck('id')->contains($student->id)) checked @endif>
                                    <label class="form-check-label" for="student_{{ $student->id }}">{{ $student->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="pedagogicalPaths" class="form-label">Pedagogical Paths</label>
                    <div class="card">
                        <div class="card-body">
                            @foreach ($pedagogicalPaths as $path)
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="path_{{ $path->id }}" name="pedagogical_paths[]" value="{{ $path->id }}"
                                        @if ($group->pedagogicalPaths && $group->pedagogicalPaths->pluck('id')->contains($path->id)) checked @endif>
                                    <label class="form-check-label" for="path_{{ $path->id }}">{{ $path->title }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Update Group
                </button>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Enable Bootstrap tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
</script>
@endpush
