@extends('layouts.admin')

@section('content')
<style>
    body {
        background-color: #f8f9fa; /* Light background for contrast */
        font-family: 'Arial', sans-serif; /* Modern font */
    }

    .title {
        margin-bottom: 20px;
    }

    .page-title {
        color: #1E40AF; /* Blue color for title */
    }

    .card {
        margin-top: 20px;
        border-radius: 15px; /* Rounded corners */
        box-shadow: 0 2px 15px rgba(0, 0, 0, 0.1); /* Subtle shadow for depth */
    }

    .card-header {
        background-color: #1E40AF; /* Header background color */
        color: #FFFFFF; /* White text */
        font-size: 1.5rem; /* Larger font size */
        padding: 20px; /* Increased padding */
        border-top-left-radius: 15px; /* Rounded corners */
        border-top-right-radius: 15px; /* Rounded corners */
    }

    .table {
        margin-bottom: 0;
        border-radius: 10px; /* Rounded table corners */
        overflow: hidden; /* Prevent overflow of rounded corners */
    }

    .table thead th {
        background-color: #e2e6ea; /* Light gray background for header */
        color: #1E40AF; /* Header text color */
    }

    .table tbody tr:nth-child(even) {
        background-color: #f2f2f2; /* Light gray for even rows */
    }

    .table tbody tr:hover {
        background-color: #d9edf7; /* Light blue on hover */
        transition: background-color 0.3s ease; /* Smooth transition */
    }

    .btn {
        border-radius: 10px; /* Rounded button corners */
        padding: 8px 15px; /* Button padding */
        transition: background-color 0.3s ease, transform 0.2s; /* Smooth transitions */
        display: flex; /* Flex display for alignment */
        align-items: center; /* Center items vertically */
        gap: 5px; /* Spacing between icon and text */
    }

    .btn:hover {
        transform: translateY(-2px); /* Slight lift effect */
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); /* Shadow on hover */
    }

    .btn-success {
        background-color: #FFA000; /* Custom success button color */
        border-color: #FFA000; /* Same border color */
    }

    .btn-success:hover {
        background-color: #FF8F00; /* Darker orange on hover */
    }

    .btn-info {
        background-color: #1E40AF; /* Info button color */
        border-color: #1E40AF; /* Same border color */
        color: #FFFFFF; /* White text */
    }

    .btn-info:hover {
        background-color: #1A3E8E; /* Darker blue on hover */
    }

    .btn-danger {
        background-color: #FFA000; /* Custom danger button color */
        border-color: #FFA000; /* Same border color */
    }

    .btn-danger:hover {
        background-color: #FF8F00; /* Darker orange on hover */
    }

    .badge-info {
        background-color: #17a2b8; /* Bootstrap badge color */
    }

    /* Icon Styles */
    .action-icons {
        font-size: 1.2rem; /* Icon size */
        transition: color 0.3s ease; /* Smooth color transition */
    }

    .action-icons:hover {
        color: #F97316; /* Change color on hover */
    }
    
    .button-group {
        display: flex; /* Flexbox for button alignment */
        gap: 10px; /* Space between buttons */
    }
</style>

<!-- Add Font Awesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

<div class="title d-flex justify-content-between align-items-center mb-4">
    <h3 class="page-title">Lessons</h3>
    @can('lesson_create')
    <p>
        <a href="{{ route('admin.lessons.create') }}" class="btn btn-success">
            <i class="fas fa-plus-circle"></i> Add New
        </a>
    </p>
    @endcan
</div>

<p class="m-0">
    <ul class="d-flex list-unstyled" style="column-gap: 1rem;">
        <li><a href="{{ route('admin.lessons.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700; color: #1E40AF;' }}">All</a></li> |
        <li><a href="{{ route('admin.lessons.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700; color: #1E40AF;' : '' }}">Trash</a></li>
    </ul>
</p>

<div class="card">
    <div class="card-header">Lessons</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover datatable datatable-Location">
                <thead>
                    <tr>
                        <th width="10">#</th>
                        <th>Course</th>
                        <th>Title</th>
                        <th>Position</th>
                        <th>Free Lesson</th>
                        <th>Published</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($lessons as $lesson)
                    <tr data-entry-id="{{ $lesson->id }}">
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <span class="badge badge-info">{{ $lesson->course->title }}</span>
                        </td>
                        <td>{{ $lesson->title ?? '' }}</td>
                        <td>{{ $lesson->position }}</td>
                        <td>{{ $lesson->free_lesson ? 'Yes' : 'No' }}</td>
                        <td>{{ $lesson->published ? 'Active' : 'Inactive' }}</td>
                        <td>
                            @if(request('show_deleted') == 1)
                            <div class="button-group">
                                <form action="{{ route('admin.lessons.restore', $lesson->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    <button type="submit" class="btn btn-xs btn-info">
                                        <i class="fas fa-undo action-icons"></i> Restore
                                    </button>
                                </form>
                                <form action="{{ route('admin.lessons.perma_del', $lesson->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-xs btn-danger">
                                        <i class="fas fa-trash action-icons"></i> Delete
                                    </button>
                                </form>
                            </div>
                            @else
                            <div class="button-group">
                                <a class="btn btn-xs btn-info" href="{{ route('admin.lessons.edit', $lesson->id) }}">
                                    <i class="fas fa-edit action-icons"></i> Edit
                                </a>
                                <form action="{{ route('admin.lessons.destroy', $lesson->id) }}" method="POST" onsubmit="return confirm('Are you sure?');">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-xs btn-danger">
                                        <i class="fas fa-trash action-icons"></i> Delete
                                    </button>
                                </form>
                            </div>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="text-center" colspan="7">No data found!</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
