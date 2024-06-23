@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
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
                    <label for="name" class="form-label">Group Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}">
                </div>

                <div class="mb-3">
                    <label for="students" class="form-label">Students</label>
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
                    <label for="pedagogical_paths" class="form-label">Pedagogical Paths</label>
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
                    <label for="courses" class="form-label">Courses</label>
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
                    <button type="submit" class="btn btn-primary w-100">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
