@extends('layouts.admin')

@section('content')

<div class="title d-flex justify-content-between align-items-center mb-4">
    <h3 class="page-title" style="color: #1E40AF;">Lessons</h3>
    @can('lesson_create')
    <p>
        <a href="{{ route('admin.lessons.create') }}" class="btn btn-success" style="background-color: #FFA000; border-color: #FFA000;">Add New</a>
    </p>
    @endcan
</div>

<p class="m-0">
    <ul class="d-flex list-unstyled" style="column-gap: 1rem">
        <li><a href="{{ route('admin.lessons.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700; color: #1E40AF;' }}">All</a></li> |
        <li><a href="{{ route('admin.lessons.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700; color: #1E40AF;' : '' }}">Trash</a></li>
    </ul>
</p>

<div class="card">
    <div class="card-header" style="background-color: #1E40AF; color: #FFFFFF;">
        Lessons
    </div>
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
                            <form action="{{ route('admin.lessons.restore', $lesson->id) }}" method="POST" onsubmit="return confirm('Are you sure ?');" style="display: inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-xs btn-info" style="background-color: #FFA000; border-color: #FFA000;">Restore</button>
                            </form>
                            <form action="{{ route('admin.lessons.perma_del', $lesson->id) }}" method="POST" onsubmit="return confirm('Are you sure ?');" style="display: inline-block;">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-xs btn-danger" style="background-color: #FFA000; border-color: #FFA000;">Delete</button>
                            </form>
                            @else
                            <a class="btn btn-xs btn-info" href="{{ route('admin.lessons.edit', $lesson->id) }}" style="background-color: #1E40AF; border-color: #1E40AF; color: #FFFFFF;">Edit</a>
                            <form action="{{ route('admin.lessons.destroy', $lesson->id) }}" method="POST" onsubmit="return confirm('Are you sure ?');" style="display: inline-block;">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-xs btn-danger" style="background-color: #FFA000; border-color: #FFA000;">Delete</button>
                            </form>
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
