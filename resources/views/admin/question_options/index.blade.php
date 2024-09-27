@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm border-0 rounded-4 animate__animated animate__fadeIn">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-question-circle me-2"></i> Question Option</h5>
        </div>

        <div class="card-body">
            <div class="title d-flex justify-content-between align-items-center mb-3">
                <h3 class="page-title text-primary"><i class="fas fa-list me-2"></i> Question Option</h3>
                @can('questions_option_create')
                <p>
                    <a href="{{ route('admin.question_options.create') }}" class="btn btn-success btn-lg rounded-pill shadow-sm" style="background-color: #FFA000; border-color: #FFA000;">
                        <i class="fas fa-plus-circle"></i> Add New
                    </a>
                </p>
                @endcan
            </div>

            <p class="mb-4">
                <ul class="nav nav-pills">
                    <li class="nav-item">
                        <a class="nav-link {{ request('show_deleted') == 1 ? '' : 'active font-weight-bold' }}" href="{{ route('admin.question_options.index') }}">All</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request('show_deleted') == 1 ? 'active font-weight-bold' : '' }}" href="{{ route('admin.question_options.index') }}?show_deleted=1">Trash</a>
                    </li>
                </ul>
            </p>

            <div class="table-responsive">
                <table class="table table-bordered table-hover datatable datatable-Location animate__animated animate__fadeInUp">
                    <thead class="table-light">
                        <tr>
                            <th width="10">#</th>
                            <th><i class="fas fa-question me-1"></i> Question</th>
                            <th><i class="fas fa-align-left me-1"></i> Option Text</th>
                            <th><i class="fas fa-check-circle me-1"></i> Correct</th>
                            <th><i class="fas fa-cogs me-1"></i> Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($question_options as $question_option)
                        <tr data-entry-id="{{ $question_option->id }}">
                            <td></td>
                            <td>{{ $question_option->question->question ?? '' }}</td>
                            <td>{!! $question_option->option_text !!}</td>
                            <td>{{ $question_option->correct == 1 ? 'true' : 'false' }}</td>
                            <td>
                                @if( request('show_deleted') == 1 )
                                <form action="{{ route('admin.question_options.restore', $question_option->id) }}" method="POST" onsubmit="return confirm('Are you sure?');" style="display: inline-block;">
                                    @csrf
                                    <button type="submit" class="btn btn-xs btn-info rounded-pill shadow-sm" style="background-color: #FFA000; border-color: #FFA000;">
                                        <i class="fas fa-undo"></i> Restore
                                    </button>
                                </form>
                                <form action="{{ route('admin.question_options.perma_del', $question_option->id) }}" method="POST" onsubmit="return confirm('Are you sure?');" style="display: inline-block;">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-xs btn-danger rounded-pill shadow-sm" style="background-color: #FF5722; border-color: #FF5722;">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </form>
                                @else
                                <a class="btn btn-xs btn-info rounded-pill shadow-sm" href="{{ route('admin.question_options.edit', $question_option->id) }}" style="background-color: #1E40AF; border-color: #1E40AF; color: #FFFFFF;">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('admin.question_options.destroy', $question_option->id) }}" method="POST" onsubmit="return confirm('Are you sure?');" style="display: inline-block;">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-xs btn-danger rounded-pill shadow-sm" style="background-color: #FF5722; border-color: #FF5722;">
                                        <i class="fas fa-trash-alt"></i> Delete
                                    </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="text-center" colspan="5"><i class="fas fa-exclamation-circle"></i> No Data Found!</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- CSS for Animations and Styles -->
<style>
    /* General Styles */
    .table-responsive {
        animation: fadeIn 0.5s ease-in-out;
    }

    .btn {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .nav-pills .nav-link {
        border-radius: 50px;
        transition: background-color 0.3s ease;
    }

    .nav-pills .nav-link.active {
        background-color: #1E40AF;
        color: white;
    }

    /* Animations */
    @keyframes fadeIn {
        0% {
            opacity: 0;
            transform: translateY(20px);
        }
        100% {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Icon Styling */
    .fa-question, .fa-align-left, .fa-check-circle, .fa-cogs {
        margin-right: 8px;
    }
</style>

<!-- Include Icons Library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection
