@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h1 class="mb-0">{{ $group->name }} - Students</h1>
            <span class="badge bg-light text-dark">{{ $group->users->count() }} Students</span>
        </div>
        <div class="card-body">
            @if (session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover align-middle">
                    <thead class="table-dark">
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($group->users as $user)
                            <tr>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <form action="{{ route('admin.groups.restrictStudent', [$group->id, $user->id]) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        <button type="submit" class="btn btn-warning btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Restrict">
                                            <i class="fas fa-user-lock"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.groups.removeStudent', [$group->id, $user->id]) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        <button type="submit" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Remove">
                                            <i class="fas fa-user-minus"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Enable Bootstrap tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
</script>
@endpush
