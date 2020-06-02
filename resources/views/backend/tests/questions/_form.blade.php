@php /* @var App\Entities\Test\TestQuestion $question */ @endphp

<div class="form-group">
    <label for="question-en">{{ __('backend.question_en') }}</label>
    <input type="text" id="question-en" name="question_en" value="{{ old('question_en', $question->question_en) }}"
           class="form-control {{ $errors->has('question_en') ? 'is-invalid' : '' }}" autofocus>

    @if($errors->has('question_en'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('question_en') }}</strong>
        </div>

    @endif
</div>
<div class="form-group">
    <label for="question-ru">{{ __('backend.question_ru') }}</label>
    <input type="text" id="question-ru" name="question_ru" value="{{ old('question_ru', $question->question_ru) }}"
           class="form-control {{ $errors->has('question_ru') ? 'is-invalid' : '' }}">

    @if($errors->has('question_ru'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('question_ru') }}</strong>
        </div>

    @endif
</div>
<div class="form-group">
    <label for="correct-answer">{{ __('backend.correct_answer') }}</label>
    <input type="text" id="correct-answer" name="correct_answer" value="{{ old('correct_answer', $question->correct_answer) }}"
           class="form-control {{ $errors->has('correct_answer') ? 'is-invalid' : '' }}">

    @if($errors->has('correct_answer'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('correct_answer') }}</strong>
        </div>

    @endif
</div>
