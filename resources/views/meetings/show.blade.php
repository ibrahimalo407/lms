@extends('layouts.admin')

@section('content')

    <h1>Zoom Meeting Details</h1>
    <p>Topic: {{ $meeting['topic'] }}</p>
    <p>Start Time: {{ $meeting['start_time'] }}</p>
    <p>Duration: {{ $meeting['duration'] }} minutes</p>
    <p>Join URL: <a href="{{ $meeting['join_url'] }}">{{ $meeting['join_url'] }}</a></p>

@endsection
