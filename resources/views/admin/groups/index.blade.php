<!-- resources/views/admin/groups/index.blade.php -->

@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="page-title text-primary">Group Management</h3>
        <a href="{{ route('admin.groups.create') }}" class="btn btn-primary">New Group</a>
    </div>

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

    <div class="card">
        <div class="card-header bg-primary text-white">Groups List</div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover table-sm datatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Number of Students</th>
                            <th>Pedagogical Paths</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($groups as $group)
                            <tr data-entry-id="{{ $group->id }}">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $group->name }}</td>
                                <td>{{ $group->students->count() }}</td>
                                <td>
                                    <ul>
                                        @foreach ($group->pedagogicalPaths as $path)
                                            <li>{{ $path->title }}</li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td>
                                    <a href="{{ route('admin.groups.edit', $group->id) }}" class="btn btn-primary btn-sm">Add Student</a>
                                    <form action="{{ route('admin.groups.destroy', $group->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
