@extends('layouts.front')

<br>
<br>
<br>
<br>
<br>
<br>
<br>


@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h1 class="mb-0">Notifications</h1>
        </div>
        <div class="card-body">
            @foreach (auth()->user()->notifications as $notification)
                <div class="alert alert-info">
                    {{ $notification->data['message'] }}
                    <a href="{{ $notification->data['url'] }}" class="btn btn-primary btn-sm">View</a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection


