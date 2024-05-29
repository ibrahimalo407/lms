<!-- resources/views/admin/virtual_classes/create.blade.php -->
@extends('layouts.admin')

@section('content')
<form action="{{ route('create-zoom-meeting') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="title">Titre</label>
        <input type="text" class="form-control" id="title" name="title" required>
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <textarea class="form-control" id="description" name="description" required></textarea>
    </div>
    <div class="form-group">
        <label for="start_time">Heure de début</label>
        <input type="datetime-local" class="form-control" id="start_time" name="start_time" required>
    </div>
    <div class="form-group">
        <label for="end_time">Heure de fin</label>
        <input type="datetime-local" class="form-control" id="end_time" name="end_time" required>
    </div>
    <div class="form-group">
        <label for="duration">Durée (minutes)</label>
        <input type="number" class="form-control" id="duration" name="duration" required>
    </div>
    <button type="submit" class="btn btn-primary">Créer une classe virtuelle</button>
</form>


@endsection
