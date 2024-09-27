@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h1 class="mb-0">Inviter des Groupes</h1>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.meetings.inviteGroups', $meeting->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="group_ids" class="form-label" style="color: #1E40AF;">Sélectionnez les Groupes</label>
                    <select name="group_ids[]" id="group_ids" class="form-control" multiple>
                        @foreach($groups as $group)
                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-warning text-white animated-button">Envoyer les Invitations</button>
            </form>

            @if (session('success'))
                <div class="alert alert-success mt-3">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </div>
</div>

<style>
    .animated-button {
        background-color: #ff9800;
        border: none;
        color: white;
        padding: 10px 20px;
        text-align: center;
        font-size: 16px;
        border-radius: 5px;
        transition: background-color 0.3s ease, transform 0.2s;
    }

    .animated-button:hover {
        background-color: #ffcc00;
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    }

    .animated-button:focus {
        outline: none;
        box-shadow: 0 0 0 0.2rem rgba(255, 204, 0, 0.5);
    }

    /* Custom form label color */
    .form-label {
        color: #1E40AF; /* Primary blue color */
    }

    /* Select box enhancements */
    #group_ids {
        transition: border-color 0.3s;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    #group_ids:focus {
        border-color: #1E40AF;
        box-shadow: 0 0 5px rgba(30, 64, 175, 0.5);
    }
</style>
@endsection
