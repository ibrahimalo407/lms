@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <div class="card shadow-sm border-0 rounded-4 animate__animated animate__fadeIn">
        <div class="card-header" style="background-color: #000000; color: #FFFFFF;">
            <h5 class="mb-0">Edit Question</h5>
        </div>

        <div class="card-body">
            <form action="{{ route('admin.questions.update', $question->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="form-group {{ $errors->has('question') ? 'has-error' : '' }}">
                    <label for="question">Question*</label>
                    <textarea id="question" name="question" rows="5" class="form-control" required>{{ old('question', isset($question) ? $question->question : '') }}</textarea>
                    @if($errors->has('question'))
                        <em class="invalid-feedback text-danger">{{ $errors->first('question') }}</em>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('question_image') ? 'has-error' : '' }}">
                    <label for="question_image">Question Image*</label>
                    <input type="file" id="question_image" name="question_image" class="form-control" accept="image/*" />
                    @if($errors->has('question_image'))
                        <em class="invalid-feedback text-danger">{{ $errors->first('question_image') }}</em>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('score') ? 'has-error' : '' }}">
                    <label for="score">Score*</label>
                    <input type="number" id="score" name="score" class="form-control" value="{{ old('score', isset($question) ? $question->score : '') }}" required />
                    @if($errors->has('score'))
                        <em class="invalid-feedback text-danger">{{ $errors->first('score') }}</em>
                    @endif
                </div>

                <div class="form-group {{ $errors->has('test') ? 'has-error' : '' }}">
                    <label for="test">Test*</label>
                    <select name="test[]" class="form-control" id="test" multiple>
                        @foreach($tests as $id => $test)
                            <option value="{{ $id }}" {{ in_array($id, $question->tests->pluck('id')->toArray()) ? 'selected' : '' }}>{{ $test }}</option>
                        @endforeach
                    </select>
                    @if($errors->has('test'))
                        <em class="invalid-feedback text-danger">{{ $errors->first('test') }}</em>
                    @endif
                </div> 

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
</style>
@endsection
