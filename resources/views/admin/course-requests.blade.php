@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="card shadow-lg border-0 rounded-4 animate__animated animate__fadeIn">
        <div class="card-header" style="background-color: #0d6efd; color: #FFFFFF;">
            <h5 class="mb-0">Course Requests</h5>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success animate__animated animate__fadeIn">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger animate__animated animate__fadeIn">
                    {{ session('error') }}
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="thead-light">
                        <tr>
                            <th>User</th>
                            <th>Course</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($requests as $request)
                            <tr>
                                <td>{{ $request->user->name }}</td>
                                <td>{{ $request->course->title }}</td>
                                <td>
                                    <span class="badge badge-{{ $request->status == 'approved' ? 'success' : 'danger' }}">
                                        {{ ucfirst($request->status) }}
                                    </span>
                                </td>
                                <td class="d-flex justify-content-around align-items-center">
                                    <form action="{{ route('admin.course-requests.approve', $request->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        <button type="submit" class="btn btn-success btn-sm" style="transition: background-color 0.3s;">
                                            <i class="fas fa-check mr-1"></i>Approve
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.course-requests.reject', $request->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm" style="transition: background-color 0.3s;">
                                            <i class="fas fa-times mr-1"></i>Reject
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

<style>
    /* Add smooth transitions for buttons */
    .btn {
        transition: background-color 0.3s ease, transform 0.3s ease;
        border-radius: 0.25rem; /* Rounded buttons */
    }

    .btn:hover {
        transform: scale(1.05); /* Slightly scale button on hover */
    }

    /* Adjusting the badge colors */
    .badge-success {
        background-color: #28a745 !important;
    }

    .badge-danger {
        background-color: #dc3545 !important;
    }

    /* Add hover effect to rows */
    .table tbody tr:hover {
        background-color: rgba(13, 110, 253, 0.1); /* Lighten the row on hover */
    }
</style>
