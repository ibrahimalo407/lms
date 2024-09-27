@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm border-0 rounded-4 animate__animated animate__fadeIn">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Create Question Option</h5>
            <i class="fas fa-question-circle"></i>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.questions.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Test Selector with Icon -->
                <div class="mb-4 position-relative">
                    <label for="question_id" class="form-label text-primary fw-bold">
                        <i class="fas fa-list-alt"></i> Test*
                    </label>
                    <select name="question_id" style="padding: 10px" class="form-control border-primary rounded-pill shadow-sm" id="question_id">
                        @foreach($questions as $id => $question)
                            <option value="{{ $id }}">{{ $question }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('question_id'))
                        <em class="invalid-feedback d-block mt-1">
                            <i class="fas fa-exclamation-circle"></i> {{ $errors->first('question_id') }}
                        </em>
                    @endif
                </div>

                <!-- Option Text with Icon -->
                <div class="mb-4 position-relative">
                    <label for="option_text" class="form-label text-primary fw-bold">
                        <i class="fas fa-edit"></i> Option Text*
                    </label>
                    <textarea id="option_text" name="option_text" rows="5" class="form-control border-primary rounded-pill shadow-sm" required>{{ old('option_text', isset($question_option) ? $question_option->option_text : '') }}</textarea>
                    @if($errors->has('option_text'))
                        <em class="invalid-feedback d-block mt-1">
                            <i class="fas fa-exclamation-circle"></i> {{ $errors->first('option_text') }}
                        </em>
                    @endif
                </div>

                <!-- Switch for Correct Option -->
                <div class="form-check form-switch mb-4 position-relative">
                    <input class="form-check-input shadow-sm" type="checkbox" name="correct" id="correct" style="width: 45px; height: 25px;">
                    <label class="form-check-label text-primary fw-bold ms-2" for="correct">
                        <i class="fas fa-check-circle"></i> Correct*
                    </label>
                    @if($errors->has('correct'))
                        <em class="invalid-feedback d-block mt-1">
                            <i class="fas fa-exclamation-circle"></i> {{ $errors->first('correct') }}
                        </em>
                    @endif
                </div>

                <!-- Submit Button with Animated Icon -->
                <div class="d-flex justify-content-end">
                    <button class="btn btn-warning btn-lg rounded-pill shadow-sm btn-animate position-relative" type="submit">
                        <i class="fas fa-save animate__animated animate__bounceIn"></i> Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Styles and Animations -->
<style>
    /* General Form and Button Styles */
    .form-control {
        transition: all 0.3s ease;
        padding: 12px 20px;
        font-size: 1rem;
    }
    
    .form-control:focus {
        box-shadow: 0 0 10px rgba(30, 64, 175, 0.4);
        border-color: #1E40AF;
    }

    /* Button Animation */
    .btn-animate {
        transition: background-color 0.3s ease, transform 0.3s ease;
        background-color: #FF9800;
        border: none;
    }

    .btn-animate:hover {
        background-color: #FF6D00;
        transform: translateY(-3px);
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .form-check-input {
        background-color: #ccc;
        border-radius: 50px;
    }

    .form-check-input:checked {
        background-color: #1E40AF;
        border-color: #1E40AF;
    }

    /* Icon Animations */
    .fa-save {
        margin-right: 10px;
        animation: bounce 1s infinite;
    }

    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% {
            transform: translateY(0);
        }
        40% {
            transform: translateY(-10px);
        }
        60% {
            transform: translateY(-5px);
        }
    }

    /* Tooltip and Icon Animations */
    .form-check-label:hover {
        color: #1E40AF;
        transition: color 0.3s ease;
    }

    .invalid-feedback {
        color: #FF0000;
    }

    /* Rounded corners for inputs and buttons */
    .rounded-pill {
        border-radius: 50px !important;
    }

    /* Subtle fade-in animations for cards */
    body, .card {
        animation: fadeIn 0.6s ease-in-out;
    }

    @keyframes fadeIn {
        0% { opacity: 0; transform: translateY(20px); }
        100% { opacity: 1; transform: translateY(0); }
    }
</style>

<!-- Icon Animations Library -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet"/>
@endsection
