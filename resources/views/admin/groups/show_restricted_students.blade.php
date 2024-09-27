@extends('layouts.admin')

@section('content')
<style>
    body {
        background-color: #f8f9fa; /* Light background for better contrast */
    }

    h1 {
        color: #007bff; /* Primary blue color for headers */
    }

    .alert {
        border-radius: 0.25rem; /* Rounded corners for alerts */
    }

    .table {
        color: #333; /* Dark text for table for better readability */
    }

    .table th {
        background-color: #007bff; /* Blue background for header */
        color: #fff; /* White text for header */
    }

    .table td {
        vertical-align: middle; /* Center align text in cells */
    }

    .btn-danger {
        background-color: #dc3545; /* Bootstrap danger color */
        border: none;
    }

    .btn-danger:hover {
        background-color: #c82333; /* Darker shade on hover */
    }

    .table-responsive {
        margin-top: 20px; /* Spacing for the table */
    }
</style>

<div class="container mt-5">
    <h1 class="mb-4">{{ $group->name }} - Restricted Students</h1>

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($group->users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <form action="{{ route('admin.groups.removeStudent', [$group->id, $user->id]) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-danger">
                                    <i class="fas fa-trash-alt"></i> Remove
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
