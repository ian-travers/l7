@php /* @var App\Entities\Blog\Post\Post $post */ @endphp

<div class="row">
    <div class="col-md-7">
        <div class="form-group">
            <label for="title" class="required-field">{{ __('user.post-title') }}</label>
            <input type="text" id="title" name="title" value="{{ old('title', $post->title) }}"
                   class="form-control {{ $errors->has('title') ? 'is-invalid' : '' }}" autofocus>
            @if($errors->has('title'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('title') }}</strong>
                </div>
            @endif
        </div>

        <div class="form-group">
            <label for="excerpt" class="required-field">{{ __('user.post-excerpt') }}</label>
            <textarea id="excerpt" name="excerpt" class="form-control {{ $errors->has('excerpt') ? 'is-invalid' : '' }}">{{ old('excerpt', $post->excerpt) }}</textarea>
            @if($errors->has('excerpt'))
                <div class="invalid-feedback">
                    <strong>{{ $errors->first('excerpt') }}</strong>
                </div>
            @endif
        </div>
    </div>
    <div class="col-md-5">
        <image-upload
            field_caption="{{ __('user.post-image') }}"
            button_caption="{{ __('user.select-image') }}"
            remove="{{ __('user.remove-image') }}"
            hint="{{ __('user.image-hint') }}"
            initial_image="{{ $post->image ? asset($post->image) : null }}"
            post_id="{{ $post->id }}"
            caution="{{ __('user.caution') }}"
            save_warning="{{ __('user.save-warning') }}"
            remove_image_question="{{ __('user.remove-image-question') }}"
        ></image-upload>
    </div>
</div>

<div class="form-group">
    <label for="body" class="required-field">{{ __('user.post-body') }}</label>
    <textarea id="body" name="body" class="form-control {{ $errors->has('body') ? 'is-invalid' : '' }}" rows="6">{{ old('body', $post->body) }}</textarea>
    @if($errors->has('body'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('body') }}</strong>
        </div>
    @endif
</div>

@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            let locale = "{{ language()->getLongCode() }}";
            $('#body').summernote({
                height: 250,
                minHeight: 150,
                lang: locale,
            });
        });
    </script>
@endsection
