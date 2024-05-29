@extends('layouts.admin')

@section('content')

    <h1>Create a Zoom Meeting</h1>
    <form action="{{ route('zoom.meeting.create') }}" method="POST">
        @csrf
        <label for="topic">Meeting Topic:</label>
        <input type="text" id="topic" name="topic" required>

        <label for="start_time">Start Time:</label>
        <input type="datetime-local" id="start_time" name="start_time" required>

        <label for="duration">Duration (minutes):</label>
        <input type="number" id="duration" name="duration" required>

        <button type="submit">Create Meeting</button>
    </form>

@endsection
