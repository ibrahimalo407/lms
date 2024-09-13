@extends('layouts.front')

<br>
<br>
<br>
<br>
<br>
@section('content')
    <div class="container">
        <h1>Mes Devoirs Non Complétés</h1>

        @if($assignments->isEmpty())
            <p>Aucun devoir en attente.</p>
        @else
            <ul>
                @foreach($assignments as $assignment)
                    <li>
                        <a href="{{ route('student.assignments.show', $assignment->id) }}">
                            {{ $assignment->title }} - Date limite : {{ \Carbon\Carbon::parse($assignment->due_date)->format('d/m/Y') }}
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
