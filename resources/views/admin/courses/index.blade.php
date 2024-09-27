@extends('layouts.admin')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h3 class="page-title text-primary">Course Management</h3>
    @can('course_create')
    <a href="{{ route('admin.courses.create') }}" class="btn btn-primary align-middle"><i class="fas fa-plus-circle"></i> Add New Course</a>
    @endcan
</div>

<div class="filter-links mb-4">
    <ul class="list-unstyled mb-0">
        <li class="d-inline-block mr-3">
            <a href="{{ route('admin.courses.index') }}" class="{{ request('show_deleted') == 1 ? '' : 'font-weight-bold text-primary' }}">All Courses</a>
        </li>
        <li class="d-inline-block mx-2">
            <a href="{{ route('admin.courses.index') }}?show_deleted=1" class="{{ request('show_deleted') == 1 ? 'font-weight-bold text-primary' : '' }}">Trash</a>
        </li>
    </ul>
</div>

<div class="card shadow-lg rounded">
    <div class="card-header bg-primary text-white d-flex align-items-center">
        <i class="fas fa-list fa-lg mr-2"></i>
        <h5 class="mb-0">Courses List</h5>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover table-sm datatable">
                <thead>
                    <tr>
                        <th>#</th>
                        @if(auth()->user()->isAdmin())
                        <th>Teacher Name</th>
                        @endif
                        <th>Title</th>
                        <th>Slug</th>
                        <th>Description</th>
                        <th>Price</th>
                        <th>Course Image</th>
                        <th>Start Date</th>
                        <th>Published</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($courses as $key => $course)
                    <tr data-entry-id="{{ $course->id }}">
                        <td>{{ $loop->iteration }}</td>
                        @if(auth()->user()->isAdmin())
                        <td>
                            @foreach ($course->teachers as $singleTeacher)
                            <span class="badge badge-info">{{ $singleTeacher->name }}</span>
                            @endforeach
                        </td>
                        @endif
                        <td>{{ $course->title }}</td>
                        <td>{{ $course->slug }}</td>
                        <td>{{ Str::limit($course->description, 50) }}</td>
                        <td>{{ $course->price }}</td>
                        <td><img width="150" src="{{ Storage::url($course->course_image) }}" alt="{{ $course->title }}" class="img-thumbnail"></td>
                        <td>{{ $course->start_date }}</td>
                        <td>{{ $course->published ? 'Active' : 'Inactive' }}</td>
                        <td>
                            @if(request('show_deleted') == 1)
                            <div class="btn-group" role="group">
                                <form action="{{ route('admin.courses.restore', $course->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to restore this course?');" class="d-inline-block">
                                    @csrf
                                    <button type="submit" class="btn btn-warning btn-sm"><i class="fas fa-undo"></i> Restore</button>
                                </form>
                                <form action="{{ route('admin.courses.perma_del', $course->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this course permanently?');" class="d-inline-block">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i> Delete</button>
                                </form>
                            </div>
                            @else
                            <div class="btn-group" role="group">
                                <a class="btn btn-primary btn-sm" href="{{ route('admin.courses.edit', $course->id) }}"><i class="fas fa-edit"></i> Edit</a>
                                <form action="{{ route('admin.courses.destroy', $course->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this course?');" class="d-inline-block">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-warning btn-sm"><i class="fas fa-trash-alt"></i> Delete</button>
                                </form>
                            </div>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="text-center" colspan="10">No courses found!</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<style>
    .card {
        border-radius: 15px;
        margin: 20px 0;
    }

    .table th, .table td {
        vertical-align: middle;
    }

    .table-hover tbody tr:hover {
        background-color: #f1f1f1;
    }

    .filter-links a {
        transition: color 0.3s;
    }

    .filter-links a:hover {
        color: #0056b3;
    }

    .btn {
        border-radius: 25px;
        transition: background-color 0.3s, transform 0.2s;
        margin-right: 5px; /* Space between buttons */
    }

    .btn:last-child {
        margin-right: 0; /* Remove margin from the last button */
    }

    .btn:hover {
        transform: scale(1.05);
    }

    .badge-info {
        background-color: #17a2b8; /* Adjust badge color */
    }
</style>
@endsection
