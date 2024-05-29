@extends('layouts.admin')

@section('content')

@if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<!-- Ajoutez votre code pour lister les classes virtuelles ici -->

<div class="container">
    <h1>Classes Virtuelles</h1>
    <a href="{{ route('admin.virtual_classes.create') }}" class="btn btn-primary">Créer une nouvelle classe virtuelle</a>

    <table class="table mt-4">
        <thead>
            <tr>
                <th>Titre</th>
                <th>Description</th>
                <th>Heure de début</th>
                <th>Heure de fin</th>
                <th>Lien de la réunion</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($virtualClasses as $virtualClass)
                <tr>
                    <td>{{ $virtualClass->title }}</td>
                    <td>{{ $virtualClass->description }}</td>
                    <td>{{ $virtualClass->start_time }}</td>
                    <td>{{ $virtualClass->end_time }}</td>
                    <td><a href="{{ $virtualClass->meeting_link }}" target="_blank">Lien de la réunion</a></td>
                    <td>
                        <!-- Actions (edit, delete, etc.) -->
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
