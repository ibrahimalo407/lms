@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Invite Users to Meeting: {{ $meeting->roomName }}</h1>

    <form action="{{ route('admin.meetings.invite', ['meeting' => $meeting->id]) }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="userIds" class="form-label">Select Users</label>
            <div class="form-check">
                @foreach ($students as $student)
                    <input class="form-check-input" type="checkbox" value="{{ $student->id }}" id="user{{ $student->id }}" name="student_ids[]">
                    <label class="form-check-label" for="user{{ $student->id }}">
                        {{ $student->name }} ({{ $student->email }})
                    </label>
                    <br>
                @endforeach
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Send Invitations</button>
    </form>
</div>
@endsection
