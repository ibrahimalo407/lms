@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg rounded" style="border: none;">
        <div class="card-header bg-gradient text-white">
            <h1 class="mb-0">New Group</h1>
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <h4 class="alert-heading">There were some errors with your submission</h4>
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.groups.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label for="name" class="text-primary">Group Name*</label>
                    <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name') }}" required>
                    @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="text-primary">Students</label>
                    @foreach($students as $student)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="students[]" value="{{ $student->id }}" id="student{{ $student->id }}">
                            <label class="form-check-label" for="student{{ $student->id }}">
                                {{ $student->name }}
                            </label>
                        </div>
                    @endforeach
                </div>

                <div class="mb-3">
                    <label class="text-primary">Pedagogical Paths</label>
                    @foreach($pedagogicalPaths as $pedagogicalPath)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="pedagogical_paths[]" value="{{ $pedagogicalPath->id }}" id="pedagogicalPath{{ $pedagogicalPath->id }}">
                            <label class="form-check-label" for="pedagogicalPath{{ $pedagogicalPath->id }}">
                                {{ $pedagogicalPath->title }}
                            </label>
                        </div>
                    @endforeach
                </div>

                <div class="mb-3">
                    <label class="text-primary">Courses</label>
                    @foreach($courses as $course)
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="courses[]" value="{{ $course->id }}" id="course{{ $course->id }}">
                            <label class="form-check-label" for="course{{ $course->id }}">
                                {{ $course->title }}
                            </label>
                        </div>
                    @endforeach
                </div>

                <div class="mb-3">
                    <button type="submit" class="btn btn-warning w-100" style="background-color: #FFA000; color: #FFFFFF; transition: background-color 0.3s; border-radius: 25px;">
                        <i class="fas fa-plus-circle mr-1"></i> Create
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .bg-gradient {
        background: linear-gradient(to right, #007bff, #0d6efd);
    }

    .card {
        border-radius: 15px;
        margin: 20px 0;
    }

    .form-control {
        border: 1px solid #0d6efd;
        transition: border-color 0.3s, box-shadow 0.3s;
        border-radius: 10px;
        padding: 10px;
    }

    label{
        color: #0056b3;
    }
    .form-control:focus {
        border-color: #0056b3;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    .text-primary {
        font-weight: bold;
        font-size: 1rem;
    }

    .invalid-feedback {
        font-size: 0.875rem;
    }

    .mr-2 {
        margin-right: 0.5rem;
    }

    .mr-1 {
        margin-right: 0.25rem;
    }
</style>
@endsection
