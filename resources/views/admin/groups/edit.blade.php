@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Edit Group: {{ $group->name }}</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('admin.groups.addStudent', $group->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="student">Add Student:</label>
            <select name="student_id" id="student" class="form-control">
                @foreach ($students as $student)
                    <option value="{{ $student->id }}">{{ $student->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Add Student</button>
    </form>

    <h2 class="mt-5">Students in Group</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($group->students as $student)
                <tr>
                    <td>{{ $student->name }}</td>
                    <td>
                        <form action="{{ route('admin.groups.removeStudent', [$group->id, $student->id]) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Remove</button>
                        </form>
                        <form action="{{ route('admin.groups.restrictStudent', [$group->id, $student->id]) }}" method="POST" style="display:inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-warning">Restrict Access</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <h2 class="mt-5">Assign Pedagogical Paths</h2>
    <form action="{{ route('admin.groups.assignPaths', $group->id) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="paths">Pedagogical Paths</label>
            <select name="path_ids[]" id="paths" class="form-control" multiple>
                @foreach ($paths as $path)
                    <option value="{{ $path->id }}" {{ $group->pedagogicalPaths->contains($path->id) ? 'selected' : '' }}>{{ $path->title }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Assign Paths</button>
    </form>
</div>
@endsection
