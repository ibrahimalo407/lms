@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h1 class="mb-0">Invite Users to Meeting: {{ $meeting->roomName }}</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.meetings.invite', ['meeting' => $meeting->id]) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="userIds" class="form-label" style="color: #1E40AF;">Select Users</label>
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
                <button type="submit" class="btn btn-warning text-white animated-button">Send Invitations</button>
            </form>
        </div>
    </div>
</div>

<style>
    .animated-button {
        position: relative;
        overflow: hidden;
        transition: background-color 0.3s, transform 0.2s;
    }

    .animated-button:hover {
        background-color: #ffcc00; /* Brighten the button color on hover */
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .animated-button:focus {
        outline: none;
        box-shadow: 0 0 0 0.2rem rgba(255, 204, 0, 0.5);
    }

    /* Form label color */
    .form-label {
        color: #1E40AF; /* Primary color for labels */
    }

    label{
        color: #1E40AF;
    }
</style>
@endsection
