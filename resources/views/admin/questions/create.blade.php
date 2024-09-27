@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm border-0 rounded-4 animate__animated animate__fadeIn">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="fas fa-plus-circle"></i> Create Question</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.questions.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group {{ $errors->has('question') ? 'has-error' : '' }}">
                    <label style="color: #005285" for="question">Question*</label>
                    <textarea id="question" name="question" rows="5" class="form-control" required>{{ old('question', isset($question) ? $question->question : '') }}</textarea>
                    @if($errors->has('question'))
                        <em class="invalid-feedback text-danger">{{ $errors->first('question') }}</em>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('question_image') ? 'has-error' : '' }}">
                    <label style="color: #005285" for="question_image">Question Image*</label>
                    <input type="file" id="question_image" name="question_image" class="form-control" accept="image/*" />
                    @if($errors->has('question_image'))
                        <em class="invalid-feedback text-danger">{{ $errors->first('question_image') }}</em>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('score') ? 'has-error' : '' }}">
                    <label style="color: #005285" for="score">Score*</label>
                    <input type="number" id="score" name="score" class="form-control" value="{{ old('score', isset($question) ? $question->score : '') }}" required />
                    @if($errors->has('score'))
                        <em class="invalid-feedback text-danger">{{ $errors->first('score') }}</em>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('test') ? 'has-error' : '' }}">
                    <label for="test">Test*</label>
                    <select name="test[]" class="form-control" id="test" multiple>
                        @foreach($tests as $id => $test)
                            <option value="{{ $id }}">{{ $test }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('test'))
                        <em class="invalid-feedback text-danger">{{ $errors->first('test') }}</em>
                    @endif
                </div>

                @for ($i = 1; $i <= 4; $i++)
                <div class="card card-footer mb-3 border-0 shadow-sm" style="border-left: 4px solid #1E88E5;">
                    <div class="card-body">
                        <div class="form-group {{ $errors->has('option_text_' . $i) ? 'has-error' : '' }}">
                            <label style="color: #005285" for="option_text_{{ $i }}">Option Text*</label>
                            <textarea id="option_text_{{ $i }}" name="option_text_{{ $i }}" rows="2" class="form-control" required>{{ old('option_text_' . $i) }}</textarea>
                            @if($errors->has('option_text_' . $i))
                                <em class="invalid-feedback text-danger">{{ $errors->first('option_text_' . $i) }}</em>
                            @endif
                        </div>
                        <div class="form-group">
                            <label style="color: #005285" for="correct_{{ $i }}">Correct*</label>
                            <input style="margin-left: 5px" type="checkbox" name="correct_{{ $i }}" class="form-check-input">
                        </div>
                    </div>
                </div>
                @endfor

                <div class="text-end">
                    <button class="btn btn-warning" type="submit" style="background-color: #FFA000; border-color: #FFA000;">
                        <i class="fas fa-save"></i> Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Include Icons Library -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<style>
    .invalid-feedback {
        display: block;
    }
    .form-group {
        transition: all 0.3s ease;
    }
    .form-group:hover {
        background-color: #f8f9fa;
        border-radius: 5px;
    }
</style>
@endsection
