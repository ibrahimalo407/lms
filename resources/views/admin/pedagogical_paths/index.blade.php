@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Pedagogical Paths</h1>

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

    <a href="{{ route('admin.pedagogical-paths.create') }}" class="btn btn-primary mb-3">New Pedagogical Path</a>

    <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Presentation Video</th>
                    <th>Courses</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pedagogicalPaths as $path)
                    <tr>
                        <td>{{ $path->title }}</td>
                        <td>{{ $path->description }}</td>
                        <td>
                            @if($path->presentation_video)
                                <video width="200" controls>
                                    <source src="{{ $path->presentation_video_url }}" type="video/mp4">
                                    Your browser does not support the video tag.
                                </video>
                            @endif
                        </td>
                        <td>
                            <ul>
                                @foreach ($path->courses as $course)
                                    <li>{{ $course->title }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            <a href="{{ route('admin.pedagogical-paths.edit', $path->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('admin.pedagogical-paths.destroy', $path->id) }}" method="POST" style="display:inline-block;">
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
</div>
@endsection
