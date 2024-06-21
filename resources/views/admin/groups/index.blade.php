@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Groups</h1>

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

    <a href="{{ route('admin.groups.create') }}" class="btn btn-primary mb-3">New Group</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Students</th>
                <th>Pedagogical Paths</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($groups as $group)
                <tr>
                    <td>{{ $group->name }}</td>
                    <td>
                        @if($group->users)
                            @foreach ($group->users as $user)
                                {{ $user->name }}<br>
                            @endforeach
                        @else
                            No students assigned
                        @endif
                    </td>
                    <td>
                        @if($group->pedagogicalPaths)
                            @foreach ($group->pedagogicalPaths as $path)
                                {{ $path->title }}<br>
                            @endforeach
                        @else
                            No pedagogical paths assigned
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.groups.edit', $group->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('admin.groups.destroy', $group->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="4">No groups found</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
