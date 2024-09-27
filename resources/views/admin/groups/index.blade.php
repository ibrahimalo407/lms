@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-dark text-white d-flex justify-content-between align-items-center">
            <h1 class="mb-0" style="font-size: 1.5rem;">Groups</h1>
            <a href="{{ route('admin.groups.create') }}" class="btn btn-outline-light">
                <i class="fas fa-plus-circle"></i> New Group
            </a>
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
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Students</th>
                            <th>Pedagogical Paths</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($groups as $group)
                            <tr>
                                <td>{{ $group->name }}</td>
                                <td>
                                    @if($group->users)
                                        <span class="badge bg-info">{{ $group->users->count() }} Students</span>
                                        <br>
                                        <a href="{{ route('admin.groups.showStudents', $group->id) }}" class="btn btn-info btn-sm mt-2" data-bs-toggle="tooltip" data-bs-placement="top" title="View Students">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    @else
                                        <span class="badge bg-secondary">No students assigned</span>
                                    @endif
                                </td>
                                <td>
                                    @if($group->pedagogicalPaths)
                                        @foreach ($group->pedagogicalPaths as $path)
                                            <span class="badge bg-primary">{{ $path->title }}</span><br>
                                        @endforeach
                                    @else
                                        <span class="badge bg-secondary">No pedagogical paths assigned</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.groups.edit', $group->id) }}" class="btn btn-warning btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.groups.destroy', $group->id) }}" method="POST" style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Delete">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No groups found</td>
                            </tr>
                        @endforelse
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

<style>
    .card {
        border-radius: 0.5rem;
        overflow: hidden;
    }

    .card-header {
        background-color: #343a40;
        border-bottom: none;
    }

    .btn-outline-light {
        border-color: rgba(255, 255, 255, 0.5);
        color: #fff;
    }

    .btn-outline-light:hover {
        background-color: rgba(255, 255, 255, 0.1);
    }

    .table {
        border-collapse: collapse;
        width: 100%;
    }

    .table th, .table td {
        padding: 1rem;
        text-align: left;
        vertical-align: middle;
    }

    .table-light th {
        background-color: #f8f9fa;
        font-weight: 600;
    }

    .alert {
        border-radius: 0.25rem;
    }

    .badge {
        font-size: 0.9rem;
    }
</style>
