@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm border-0 rounded-4 animate__animated animate__fadeIn">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-edit me-2"></i> Edit Question Option</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.question_options.update', $question_option->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="form-group {{ $errors->has('question_id') ? 'has-error' : '' }}">
                    <label for="question_id" class="form-label"><i class="fas fa-question-circle me-1"></i> Test*</label>
                    <select name="question_id" class="form-control" id="question_id" required>
                        @foreach($questions as $id => $question)
                            <option {{ $id == $question_option->question_id ? 'selected' : null }} value="{{ $id }}">{{ $question }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('question_id'))
                        <em class="invalid-feedback">
                            {{ $errors->first('question_id') }}
                        </em>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('option_text') ? 'has-error' : '' }}">
                    <label for="option_text" class="form-label"><i class="fas fa-align-left me-1"></i> Option Text*</label>
                    <textarea id="option_text" name="option_text" rows="5" class="form-control" required>{{ old('option_text', isset($question_option) ? $question_option->option_text : '') }}</textarea>
                    @if($errors->has('option_text'))
                        <em class="invalid-feedback">
                            {{ $errors->first('option_text') }}
                        </em>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('correct') ? 'has-error' : '' }}">
                    <label for="correct" style="color: #10487c" class="form-label"><i class="fas fa-check-circle me-1"></i> Correct*</label>
                    <span></span>
                    <input type="checkbox" style="margin-left: 5px" name="correct" id="correct" {{ ($question_option->correct) ? 'checked' : null }} class="form-check-input">
                    @if($errors->has('correct'))
                        <em class="invalid-feedback">
                            {{ $errors->first('correct') }}
                        </em>
                    @endif
                </div>
               
                <div>
                    <button class="btn btn-success rounded-pill shadow-sm" type="submit" style="background-color: #FFA000; border-color: #FFA000;">
                        <i class="fas fa-save me-1"></i> Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- CSS for Animations and Styles -->
<style>
    .form-label {
        font-weight: 500;
        margin-bottom: 0.5rem;
    }

    span{
        width: 20px;
    }

    .btn {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .btn:hover {
        transform: translateY(-3px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
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
    .fa-question-circle, .fa-align-left, .fa-check-circle {
        margin-right: 8px;
    }
</style>

<!-- Include Icons Library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
@endsection
