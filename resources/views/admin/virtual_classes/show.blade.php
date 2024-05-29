<!-- resources/views/meetings/show.blade.php -->

@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Details de la Réunion Zoom</h1>

    @if($meeting)
        <div class="card">
            <div class="card-header">
                <h2>{{ $meeting['topic'] }}</h2>
            </div>
            <div class="card-body">
                <p><strong>ID de la Réunion :</strong> {{ $meeting['id'] }}</p>
                <p><strong>Début :</strong> {{ \Carbon\Carbon::parse($meeting['start_time'])->toDayDateTimeString() }}</p>
                <p><strong>Durée :</strong> {{ $meeting['duration'] }} minutes</p>
                <p><strong>Lien de la Réunion :</strong> <a href="{{ $meeting['join_url'] }}" target="_blank">{{ $meeting['join_url'] }}</a></p>
                <p><strong>Mot de passe :</strong> {{ $meeting['password'] }}</p>
            </div>
        </div>
    @else
        <div class="alert alert-danger">
            <p>Les détails de la réunion n'ont pas pu être récupérés.</p>
        </div>
    @endif
</div>
@endsection
