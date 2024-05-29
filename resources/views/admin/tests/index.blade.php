@extends('layouts.admin')

@section('content')

<div class="card">
    <div class="card-header" style="background-color: #1E40AF; color: #FFFFFF;">
        <h5 class="mb-0">Test</h5>
    </div>

    <div class="card-body">
        <div class="title d-flex justify-content-between">
            <h3 class="page-title">Test</h3>
            @can('test_create')
            <p>
                <a href="{{ route('admin.tests.create') }}" class="btn btn-success" style="background-color: #FFA000; border-color: #FFA000;">Add New</a>
            </p>
            @endcan
        </div>

        <p class="m-0">
            <ul class="d-flex list-unstyled" style="column-gap: 1rem">
                <li><a href="{{ route('admin.tests.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700; color: #1E40AF;' }}">All</a></li>
                <li><a href="{{ route('admin.tests.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700; color: #1E40AF;' : '' }}">Trash</a></li>
            </ul>
        </p>

        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover datatable datatable-Location">
                <thead>
                    <tr>
                        <th width="10">#</th>
                        <th>Course</th>
                        <th>Lesson</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Published</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($tests as $test)
                    <tr data-entry-id="{{ $test->id }}">
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $test->course->title ?? '' }}</td>
                        <td>{{ $test->lesson->title ?? '' }}</td>
                        <td>{{ $test->title }}</td>
                        <td>{!! $test->description !!}</td>
                        <td>{{ $test->published ? 'Active' : 'InActive' }}</td>
                        <td>
                            @if( request('show_deleted') == 1 )
                            <form action="{{ route('admin.tests.restore', $test->id) }}" method="POST" onsubmit="return confirm('Are you sure ?');" style="display: inline-block;">
                                @csrf
                                <button type="submit" class="btn btn-xs btn-info" style="background-color: #FFA000; border-color: #FFA000;">Restore</button>
                            </form>
                            <form action="{{ route('admin.tests.perma_del', $test->id) }}" method="POST" onsubmit="return confirm('Are you sure ?');" style="display: inline-block;">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-xs btn-danger" style="background-color: #1E40AF; border-color: #1E40AF;">Delete</button>
                            </form>
                            @else
                            <a class="btn btn-xs btn-info" href="{{ route('admin.tests.edit', $test->id) }}" style="background-color: #FFA000; border-color: #FFA000; color: #FFFFFF">Edit</a>
                            <form action="{{ route('admin.tests.destroy', $test->id) }}" method="POST" onsubmit="return confirm('Are you sure ?');" style="display: inline-block;">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-xs btn-danger" style="background-color: #1E40AF; border-color: #1E40AF;">Delete</button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td class="text-center" colspan="7">Data Not Found!</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
