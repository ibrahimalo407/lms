@extends('layouts.admin')

@section('content')

<div style="margin-bottom: 10px;" class="row">
    <div class="col-lg-12">
        <a class="btn btn-success" href="{{ route('admin.users.create') }}" style="background-color: #1E40AF; border-color: #1E40AF; display: flex; align-items: center; transition: background-color 0.3s;">
            <i class="fas fa-user-plus mr-2"></i>Add Users
        </a>
    </div>
</div>

<div class="card shadow-lg border-0 rounded-4 animate__animated animate__fadeIn">
    <div class="card-header" style="background-color: #1E40AF; color: #FFFFFF;">
        <h5 class="mb-0">User Management</h5>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover datatable datatable-Location">
                <thead>
                    <tr>
                        <th width="10">#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr data-entry-id="{{ $user->id }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @foreach ($user->role as $singleRole)
                                    <span class="badge badge-info">{{ $singleRole->title }}</span>
                                @endforeach
                            </td>
                            <td class="d-flex justify-content-around align-items-center">
                                <a class="btn btn-xs btn-info" href="{{ route('admin.users.edit', $user->id) }}" style="background-color: #1E40AF; border-color: #1E40AF; color: #FFFFFF; display: flex; align-items: center; transition: background-color 0.3s;">
                                    <i class="fas fa-edit mr-1"></i>Edit
                                </a>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure ?');" style="display: inline-block;">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-xs btn-danger" style="background-color: #FFA000; border-color: #FFA000; display: flex; align-items: center; transition: background-color 0.3s;">
                                        <i class="fas fa-trash-alt mr-1"></i>Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td class="text-center" colspan="5">Data Not Found!</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
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
        background-color: #0d6efd; /* Change background color on hover */
    }

    .table th, .table td {
        vertical-align: middle; /* Center align text */
        padding: 15px; /* Increased padding for better spacing */
    }

    /* Ensure the table takes the full width */
    .table {
        width: 100%;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1); /* Add subtle shadow to table */
    }

    /* Add hover effect to rows */
    .table tbody tr:hover {
        background-color: rgba(30, 64, 175, 0.1); /* Lighten the row on hover */
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .btn {
            width: 100%; /* Full width buttons on small screens */
            margin-bottom: 5px; /* Spacing between buttons */
        }
    }
</style>
