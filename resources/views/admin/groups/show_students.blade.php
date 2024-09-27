@extends('layouts.admin')

@section('content')
<style>
    body {
        background-color: #f8f9fa; /* Light background for better contrast */
    }

    .card-header {
        background-color: #007bff; /* Primary blue color */
    }

    h1 {
        color: #ffffff; /* White text for header */
    }

    .badge {
        background-color: #f8f9fa; /* Light background for badges */
        color: #343a40; /* Dark text for contrast */
    }

    .alert {
        border-radius: 0.25rem; /* Rounded corners for alerts */
    }

    .table {
        color: #333; /* Dark text for table for better readability */
    }

    .table-dark {
        background-color: #343a40; /* Dark background for header */
        color: #ffffff; /* White text for header */
    }

    .table th {
        background-color: #007bff; /* Blue background for header */
        color: #fff; /* White text for header */
    }

    .table td {
        vertical-align: middle; /* Center align text in cells */
        transition: background-color 0.2s ease; /* Transition for hover effect */
    }

    .table tr:hover {
        background-color: #e9ecef; /* Light gray background on row hover */
    }

    .btn {
        transition: transform 0.2s ease; /* Transition for button hover effect */
    }

    .btn:hover {
        transform: translateY(-2px); /* Lift effect on hover */
    }

    .btn-warning {
        background-color: #ffc107; /* Bootstrap warning color */
        border: none;
    }

    .btn-danger {
        background-color: #dc3545; /* Bootstrap danger color */
        border: none;
    }

    .btn-warning:hover {
        background-color: #e0a800; /* Darker shade on hover */
    }

    .btn-danger:hover {
        background-color: #c82333; /* Darker shade on hover */
    }

    .table-responsive {
        margin-top: 20px; /* Spacing for the table */
    }
</style>

<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h1 class="mb-0">{{ $group->name }} - Students</h1>
            <span class="badge">{{ $group->users->count() }} Students</span>
        </div>
        <div class="card-body">
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
                <table class="table table-bordered table-striped table-hover align-middle">
                    <thead class="table-dark">
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
                                    <form action="{{ route('admin.groups.restrictStudent', [$group->id, $user->id]) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        <button type="submit" class="btn btn-warning btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Restrict">
                                            <i class="fas fa-user-lock"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.groups.removeStudent', [$group->id, $user->id]) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Remove">
                                            <i class="fas fa-user-minus"></i>
                                        </button>
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

@push('scripts')
<script>
    // Enable Bootstrap tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
</script>
@endpush
