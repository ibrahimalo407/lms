@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm border-0 rounded-4 animate__animated animate__fadeIn">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-question-circle me-2"></i> Question Management</h5>
        </div>

        <div class="card-body">
            <div class="title d-flex justify-content-between mb-3">
                <h3 class="page-title">Questions</h3>
                @can('question_create')
                <a href="{{ route('admin.questions.create') }}" class="btn btn-success rounded-pill shadow-sm" style="background-color: #FFA000; border-color: #FFA000;">
                    <i class="fas fa-plus-circle me-1"></i> Add New
                </a>
                @endcan
            </div>

            <p class="m-0">
                <ul class="d-flex list-unstyled" style="column-gap: 1rem;">
                    <li><a href="{{ route('admin.questions.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700; color: #1E88E5;' }}">All</a></li> |
                    <li><a href="{{ route('admin.questions.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700; color: #1E88E5;' : 'color: #1E88E5;' }}">Trash</a></li>
                </ul>
            </p>

            <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover datatable datatable-Location">
                    <thead>
                        <tr>
                            <th width="10">#</th>
                            <th>Question</th>
                            <th>Question Image</th>
                            <th>Score</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($questions as $question)
                        <tr data-entry-id="{{ $question->id }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $question->question }}</td>
                            <td>
                                @if($question->question_image)
                                <a href="{{ Storage::url($question->question_image) }}" target="_blank">
                                    <img src="{{ Storage::url($question->question_image) }}" style="max-width: 100px; max-height: 100px;" class="img-thumbnail" />
                                </a>
                                @endif
                            </td>
                            <td>{{ $question->score }}</td>
                            <td>
                                @if(request('show_deleted') == 1)
                                <form action="{{ route('admin.questions.restore', $question->id) }}" method="POST" onsubmit="return confirm('Are you sure?');" style="display: inline-block;">
                                    @csrf
                                    <button type="submit" class="btn btn-xs btn-warning" style="background-color: #FFA000; border-color: #FFA000;">
                                        <i class="fas fa-undo"></i> Restore
                                    </button>
                                </form>
                                <form action="{{ route('admin.questions.perma_del', $question->id) }}" method="POST" onsubmit="return confirm('Are you sure?');" style="display: inline-block;">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-xs btn-danger" style="background-color: #FFA000; border-color: #FFA000;">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                                @else
                                <a class="btn btn-xs btn-info" href="{{ route('admin.questions.edit', $question->id) }}" style="background-color: #1E40AF; border-color: #1E40AF; color: #FFFFFF">
                                    <i class="fas fa-edit"></i> Edit
                                </a>
                                <form action="{{ route('admin.questions.destroy', $question->id) }}" method="POST" onsubmit="return confirm('Are you sure?');" style="display: inline-block;">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-xs btn-danger" style="background-color: #FFA000; border-color: #FFA000;">
                                        <i class="fas fa-trash"></i> Delete
                                    </button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td class="text-center" colspan="5">Data Not Found!</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Include Icons Library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<style>
    .btn {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    .img-thumbnail {
        border: 1px solid #ddd;
        border-radius: .25rem;
    }

    .table th, .table td {
        vertical-align: middle;
    }
</style>
@endsection
