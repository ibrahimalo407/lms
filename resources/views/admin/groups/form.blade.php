@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">{{ isset($group) ? 'Edit Group' : 'New Group' }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ isset($group) ? route('admin.groups.update', $group->id) : route('admin.groups.store') }}" method="POST">
        @csrf
        @if(isset($group))
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" class="form-control" id="name" name="name" value="{{ isset($group) ? $group->name : old('name') }}">
        </div>

        <div class="form-group">
            <label for="students">Students</label>
            <select name="students[]" id="students" class="form-control" multiple>
                @foreach($students as $student)
                    <option value="{{ $student->id }}" {{ isset($group) && in_array($student->id, $group->students->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $student->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="pedagogical_paths">Pedagogical Paths</label>
            <select name="pedagogical_paths[]" id="pedagogical_paths" class="form-control" multiple>
                @foreach($pedagogicalPaths as $path)
                    <option value="{{ $path->id }}" {{ isset($group) && in_array($path->id, $group->pedagogicalPaths->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $path->title }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary">{{ isset($group) ? 'Update' : 'Create' }}</button>
    </form>
</div>
@endsection
