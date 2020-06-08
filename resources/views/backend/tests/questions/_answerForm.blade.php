@php /* @var App\Entities\Test\TestAnswer $answer */ @endphp

<div class="form-group">
    <label for="answer-en">{{ __('backend.answer_en') }}</label>
    <input type="text" id="answer-en" name="answer_en" value="{{ old('answer_en', $answer->answer_en) }}"
           class="form-control {{ $errors->has('answer_en') ? 'is-invalid' : '' }}" autofocus>

    @if($errors->has('answer_en'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('answer_en') }}</strong>
        </div>

    @endif
</div>
<div class="form-group">
    <label for="answer-ru">{{ __('backend.answer_ru') }}</label>
    <input type="text" id="answer-ru" name="answer_ru" value="{{ old('answer_ru', $answer->answer_ru) }}"
           class="form-control {{ $errors->has('answer_ru') ? 'is-invalid' : '' }}">

    @if($errors->has('answer_ru'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('answer_ru') }}</strong>
        </div>

    @endif
</div>
<div class="form-group">
    <label for="index">{{ __('backend.index') }}</label>
    <input type="text" id="index" name="index" value="{{ old('index', $answer->index) }}"
           class="form-control {{ $errors->has('index') ? 'is-invalid' : '' }}">

    @if($errors->has('index'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('index') }}</strong>
        </div>

    @endif
</div>

