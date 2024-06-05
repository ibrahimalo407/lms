@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Classrooms</h1>
    <a href="{{ route('classrooms.create') }}" class="btn btn-primary">Add Classroom</a>
    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($classrooms as $classroom)
                <tr>
                    <td>{{ $classroom->name }}</td>
                    <td>{{ $classroom->description }}</td>
                    <td>
                        <a href="{{ route('classrooms.show', $classroom->id) }}" class="btn btn-info">View</a>
                        <a href="{{ route('classrooms.edit', $classroom->id) }}" class="btn btn-warning">Edit</a>
                        <form action="{{ route('classrooms.destroy', $classroom->id) }}" method="POST" style="display:inline-block;">
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
