@extends('layouts.front')

@section('content')

<style>
    /* Styles spécifiques à la vue catalog.blade.php */
    .course-card {
        flex: 1 1 calc(33.33% - 20px);
        margin: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        overflow: hidden;
        background-color: #fff;
        transition: transform 0.3s ease-in-out;
        display: flex;
        flex-direction: column;
    }

    .course-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 12px rgba(0, 0, 0, 0.1);
    }

    .course-card .card-img-top {
        height: 200px;
        object-fit: cover;
        border-radius: 8px 8px 0 0;
    }

    .course-card .card-body {
        padding: 20px;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
    }

    .course-card .card-title {
        font-size: 20px;
        font-weight: bold;
        margin-bottom: 10px;
        color: #004278;
    }

    .course-card .card-text {
        font-size: 16px;
        margin-bottom: 20px;
        color: #666;
    }

    .course-card .btn-request {
        width: 100%;
        background-color: #004278;
        color: #fff;
        border: none;
        padding: 10px 0;
        border-radius: 5px;
        transition: background-color 0.3s ease-in-out;
    }

    .course-card .btn-request:hover {
        background-color: #135d98;
    }

    .course-row {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
    }
</style>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<div class="container mt-5">
    <h1 class="mb-4" style="text-align: center">Course Catalog</h1>

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

    <div class="course-row">
        @foreach ($courses as $course)
            <div class="course-card">
                <img src="{{ Storage::url($course->course_image) }}" class="card-img-top" alt="{{ $course->title }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $course->title }}</h5>
                    <p class="card-text">{{ Str::limit($course->description, 150) }}</p>
                    <form action="{{ route('course-requests.store', $course->id) }}" method="POST">
                        @csrf
                        @if (in_array($course->id, $requestedCourses))
                            <button type="button" class="btn btn-secondary btn-request" disabled>Request Sent</button>
                        @else
                            <button type="submit" class="btn btn-request">Request Access</button>
                        @endif
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>

@endsection
