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
                    <label for="group_ids" class="form-label">Sélectionnez les Groupes</label>
                    <select name="group_ids[]" id="group_ids" class="form-control" multiple>
                        @foreach($groups as $group)
                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Envoyer les Invitations</button>
            </form>

            @if (session('success'))
                <div class="alert alert-success mt-3">
                    {{ session('success') }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
