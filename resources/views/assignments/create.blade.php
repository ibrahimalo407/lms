@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h2>Créer une nouvelle Assignation</h2>

    <form action="{{ route('assignments.store') }}" method="POST">
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
            <label for="courses">Cours</label>
            <div id="courses">
                @foreach($courses as $course)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="course_{{ $course->id }}" name="course_ids[]" value="{{ $course->id }}">
                        <label class="form-check-label" for="course_{{ $course->id }}">
                            {{ $course->title }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="form-group">
            <label for="groups">Groupes</label>
            <div id="groups">
                @foreach($groups as $group)
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="group_{{ $group->id }}" name="group_ids[]" value="{{ $group->id }}">
                        <label class="form-check-label" for="group_{{ $group->id }}">
                            {{ $group->name }}
                        </label>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="form-group">
            <label for="due_date">Date Limite</label>
            <input type="date" class="form-control" id="due_date" name="due_date" required>
        </div>

        <button type="submit" class="btn btn-success">Créer</button>
    </form>
</div>
@endsection
