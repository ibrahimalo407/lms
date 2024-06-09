@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Pedagogical Paths</h1>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('admin.pedagogical-paths.create') }}" class="btn btn-primary mb-3">New Pedagogical Path</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pedagogicalPaths as $path)
                <tr>
                    <td>{{ $path->title }}</td>
                    <td>{{ $path->description }}</td>
                    <td>
                        <a href="{{ route('admin.pedagogical-paths.edit', $path->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('admin.pedagogical-paths.destroy', $path->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
