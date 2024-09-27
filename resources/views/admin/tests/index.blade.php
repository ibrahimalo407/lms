@extends('layouts.admin')

@section('content')

<div class="container mt-5">
    <div class="card shadow-sm border-0 rounded-4 animate__animated animate__fadeIn">
        <div class="card-header" style="background-color: #1E40AF; color: #FFFFFF;">
            <h5 class="mb-0">Test Management</h5>
        </div>

        <div class="card-body">
            <div class="title d-flex justify-content-between align-items-center mb-4">
                <h3 class="page-title">Tests</h3>
                @can('test_create')
                <a href="{{ route('admin.tests.create') }}" class="btn btn-warning" style="background-color: #FFA000; border-color: #FFA000;">
                    <i class="fas fa-plus-circle"></i> Add New
                </a>
                @endcan
            </div>

            <nav class="mb-3">
                <ul class="d-flex list-unstyled" style="column-gap: 1rem;">
                    <li>
                        <a href="{{ route('admin.tests.index') }}" class="{{ request('show_deleted') == 1 ? '' : 'font-weight-bold text-primary' }}">
                            All
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.tests.index') }}?show_deleted=1" class="{{ request('show_deleted') == 1 ? 'font-weight-bold text-primary' : '' }}">
                            Trash
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover datatable datatable-Location">
                    <thead>
                        <tr>
                            <th width="10">#</th>
                            <th>Course</th>
                            <th>Lesson</th>
                            <th>Title</th>
                            <th>Description</th>
                            <th>Published</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tests as $test)
                        <tr data-entry-id="{{ $test->id }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $test->course->title ?? 'N/A' }}</td>
                            <td>{{ $test->lesson->title ?? 'N/A' }}</td>
                            <td>{{ $test->title }}</td>
                            <td class="text-truncate" style="max-width: 200px;">{!! $test->description !!}</td>
                            <td>{{ $test->published ? 'Active' : 'Inactive' }}</td>
                            <td class="d-flex justify-content-center align-items-center">
                                @if( request('show_deleted') == 1 )
                                <form action="{{ route('admin.tests.restore', $test->id) }}" method="POST" onsubmit="return confirm('Are you sure?');" style="display: inline-block;">
                                    @csrf
                                    <button type="submit" class="btn btn-xs btn-info mx-1" style="background-color: #FFA000; border-color: #FFA000;">
                                        <i class="fas fa-undo"></i> Restore
                                    </button>
                                </form>
                                <form action="{{ route('admin.tests.perma_del', $test->id) }}" method="POST" onsubmit="return confirm('Are you sure?');" style="display: inline-block;">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-xs btn-danger mx-1" style="background-color: #1E40AF; border-color: #1E40AF;">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </form>
                                @else
                                <a class="btn btn-xs btn-info mx-1" href="{{ route('admin.tests.edit', $test->id) }}" style="background-color: #FFA000; border-color: #FFA000; color: #FFFFFF">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('admin.tests.destroy', $test->id) }}" method="POST" onsubmit="return confirm('Are you sure?');" style="display: inline-block;">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-xs btn-danger mx-1" style="background-color: #1E40AF; border-color: #1E40AF;">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="text-center" colspan="7">Data Not Found!</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection

<style>
    /* Ajout de styles pour éviter les débordements */
    .text-truncate {
        overflow: hidden;
        white-space: nowrap;
        text-overflow: ellipsis;
    }

    .table {
        table-layout: fixed; /* Pour un meilleur contrôle de la taille des colonnes */
    }

    th, td {
        word-wrap: break-word; /* Pour permettre le retour à la ligne dans les cellules */
    }

    /* Ajouter un peu d'espacement dans les boutons */
    .btn {
        min-width: 50px; /* Largeur minimale pour les boutons */
    }

    /* Styles supplémentaires pour améliorer l'apparence générale */
    .page-title {
        font-weight: bold;
        font-size: 1.5rem;
        color: #1E40AF; /* Assurez-vous que cela correspond à votre palette */
    }

    .nav-link {
        color: #1E40AF;
        transition: color 0.3s;
    }

    .nav-link:hover {
        color: #FFA000; /* Changez la couleur au survol */
    }

    /* Ajouter une ombre légère aux boutons pour les rendre plus modernes */
    .btn {
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s, transform 0.2s;
    }

    .btn:hover {
        transform: translateY(-1px);
    }
</style>
