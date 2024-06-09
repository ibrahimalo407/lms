@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">{{ isset($pedagogicalPath) ? 'Edit Pedagogical Path' : 'New Pedagogical Path' }}</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ isset($pedagogicalPath) ? route('admin.pedagogical-paths.update', $pedagogicalPath->id) : route('admin.pedagogical-paths.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @if(isset($pedagogicalPath))
            @method('PUT')
        @endif

        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ isset($pedagogicalPath) ? $pedagogicalPath->title : old('title') }}">
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <textarea class="form-control" id="description" name="description">{{ isset($pedagogicalPath) ? $pedagogicalPath->description : old('description') }}</textarea>
        </div>

        <div class="form-group">
            <label for="presentation_video">Presentation Video</label>
            <input type="file" class="form-control" id="presentation_video" name="presentation_video">
        </div>

        <button type="submit" class="btn btn-primary">{{ isset($pedagogicalPath) ? 'Update' : 'Create' }}</button>
    </form>
</div>
@endsection
