@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h1 class="mb-0">Groups</h1>
            <a href="{{ route('admin.groups.create') }}" class="btn btn-success">
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
                <table class="table table-bordered table-hover align-middle">
                    <thead class="table-dark">
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
