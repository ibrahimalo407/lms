@extends('layouts.admin')

@section('content')
<div class="card">
    <div class="card-header" style="background-color: #1E40AF; color: #FFFFFF;">
        <h5 class="mb-0">Create Question Option</h5>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.questions.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group {{ $errors->has('test') ? 'has-error' : '' }}">
                <label for="question_id">Test*</label>
                <select name="question_id" class="form-control" id="question_id">
                    @foreach($questions as $id => $question)
                        <option value="{{ $id }}">{{ $question }}</option>
                    @endforeach
                </select>
                @if($errors->has('question_id'))
                    <em class="invalid-feedback">
                        {{ $errors->first('question_id') }}
                    </em>
                @endif
            </div>
            <div class="form-group {{ $errors->has('question') ? 'has-error' : '' }}">
                <label for="option_text">Option Text*</label>
                <textarea id="option_text" name="option_text" rows="5" class="form-control" required>{{ old('option_text', isset($question_option) ? $question_option->option_text : '') }}</textarea>
                @if($errors->has('option_text'))
                    <em class="invalid-feedback">
                        {{ $errors->first('option_text') }}
                    </em>
                @endif
            </div>
            <div class="form-group {{ $errors->has('score') ? 'has-error' : '' }}">
                <label for="correct">Correct*</label>
                <input type="checkbox" name="correct">
                @if($errors->has('correct'))
                    <em class="invalid-feedback">
                        {{ $errors->first('correct') }}
                    </em>
                @endif
            </div>
           
            <div>
                <button class="btn btn-danger" type="submit" style="background-color: #FFA000; border-color: #FFA000;">Save</button>
            </div>
        </form>
    </div>
</div>
@endsection
