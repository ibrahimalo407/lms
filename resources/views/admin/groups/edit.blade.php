@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Edit Group</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.groups.update', $group->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Group Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ $group->name }}">
        </div>

        <div class="form-group">
            <label for="students">Students</label>
            @foreach($students as $student)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="students[]" value="{{ $student->id }}" id="student{{ $student->id }}" {{ in_array($student->id, $group->students->pluck('id')->toArray()) ? 'checked' : '' }}>
                    <label class="form-check-label" for="student{{ $student->id }}">
                        {{ $student->name }}
                    </label>
                </div>
            @endforeach
        </div>

        <div class="form-group">
            <label for="pedagogical_paths">Pedagogical Paths</label>
            @foreach($pedagogicalPaths as $pedagogicalPath)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="pedagogical_paths[]" value="{{ $pedagogicalPath->id }}" id="pedagogicalPath{{ $pedagogicalPath->id }}" {{ in_array($pedagogicalPath->id, $group->pedagogicalPaths->pluck('id')->toArray()) ? 'checked' : '' }}>
                    <label class="form-check-label" for="pedagogicalPath{{ $pedagogicalPath->id }}">
                        {{ $pedagogicalPath->title }}
                    </label>
                </div>
            @endforeach
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
