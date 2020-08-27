@php /* @var \App\Entities\News\News $news */ @endphp

<div class="d-flex justify-content-between align-content-between">
    <div class="mr-2">
        <div class="form-group">
            <label for="title-en">{{ __('backend.title_en') }}</label>
            <input type="text" id="title-en" name="title_en" value="{{ old('title_en', $news->title_en) }}"
                   class="form-control {{ $errors->has('title_en') ? 'is-invalid' : '' }}" autofocus required>
            @if($errors->has('title_en'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('title_en') }}</strong>
                </div>
            @endif
        </div>
        <div class="form-group">
            <label for="body-en">{{ __('backend.body_en') }}</label>
            <textarea id="body-en" name="body_en" rows="5" required
                      class="form-control {{ $errors->has('body_en') ? 'is-invalid' : '' }}">{{ old('body_en', $news->body_en) }}</textarea>
            @if($errors->has('body_en'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('body_en') }}</strong>
                </div>

            @endif
        </div>
    </div>

    <div>
        <div class="form-group">
            <label for="title-ru">{{ __('backend.title_ru') }}</label>
            <input type="text" id="title-ru" name="title_ru" value="{{ old('title_ru', $news->title_ru) }}"
                   class="form-control {{ $errors->has('title_ru') ? 'is-invalid' : '' }}" required>

            @if($errors->has('title_ru'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('title_ru') }}</strong>
                </div>

            @endif
        </div>
        <div class="form-group">
            <label for="body-ru">{{ __('backend.body_ru') }}</label>
            <textarea id="body-ru" name="body_ru" rows="5" required
                      class="form-control {{ $errors->has('body_ru') ? 'is-invalid' : '' }}">{{ old('body_ru', $news->body_ru) }}</textarea>

            @if($errors->has('body_ru'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('body_ru') }}</strong>
                </div>

            @endif
        </div>
    </div>
</div>

@section('script')
    <script type="text/javascript">

        $(document).ready(function() {
            let locale = "{{ language()->getLongCode() }}";
            console.log(locale);
            $('#body-en').summernote({
                height: 250,
                minHeight: 150,
                lang: locale,
            });
            $('#body-ru').summernote({
                height: 250,
                minHeight: 150,
                lang: locale,
            });
        });
    </script>
@endsection
