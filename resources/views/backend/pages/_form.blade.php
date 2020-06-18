@php /* @var \App\Entities\Page\Page $page */ @endphp

<div class="d-flex justify-content-between align-content-between">
    <div class="form-group w-50 mr-2">
        <label for="title-en">{{ __('backend.title_en') }}</label>
        <input type="text" id="title-en" name="title_en" value="{{ old('title_en', $page->title_en) }}"
               class="form-control {{ $errors->has('title_en') ? 'is-invalid' : '' }}" autofocus required>

        @if($errors->has('title_en'))
            <div class="invalid-feedback">
                <strong>{{ $errors->first('title_en') }}</strong>
            </div>

        @endif
    </div>
    <div class="form-group w-50">
        <label for="title-ru">{{ __('backend.title_ru') }}</label>
        <input type="text" id="title-ru" name="title_ru" value="{{ old('title_ru', $page->title_ru) }}"
               class="form-control {{ $errors->has('title_ru') ? 'is-invalid' : '' }}" required>

        @if($errors->has('title_ru'))
            <div class="invalid-feedback">
                <strong>{{ $errors->first('title_ru') }}</strong>
            </div>

        @endif
    </div>
</div>

<div class="d-flex justify-content-between align-items-center">
    <div class="form-group w-40 mr-2">
        <label for="parent">{{ __('backend.parent_id') }}</label>
        <select id="parent" name="parent_id"
                class="form-control"
        >
            <option>{{ __('backend.no-parent') }}</option>
            @include('backend.pages._rootPagesSelectOptions')
        </select>


    </div>
    <div class="form-group w-20 mr-2">
        <label for="link-en">{{ __('backend.link_en') }}</label>
        <input type="text" id="link-en" name="link_en" value="{{ old('link_en', $page->link_en) }}"
               class="form-control {{ $errors->has('link_en') ? 'is-invalid' : '' }}" required>

        @if($errors->has('link_en'))
            <div class="invalid-feedback">
                <strong>{{ $errors->first('link_en') }}</strong>
            </div>

        @endif
    </div>
    <div class="form-group w-20 mr-2">
        <label for="link-ru">{{ __('backend.link_ru') }}</label>
        <input type="text" id="link-ru" name="link_ru" value="{{ old('link_ru', $page->link_ru) }}"
               class="form-control {{ $errors->has('link_ru') ? 'is-invalid' : '' }}" required>

        @if($errors->has('link_ru'))
            <div class="invalid-feedback">
                <strong>{{ $errors->first('link_ru') }}</strong>
            </div>

        @endif
    </div>
    <div class="form-group w-20">
        <label for="path">{{ __('backend.path') }}</label>
        <input type="text" id="path" name="path" value="{{ old('path', $page->path) }}"
               class="form-control {{ $errors->has('path') ? 'is-invalid' : '' }}" required>

        @if($errors->has('path'))
            <div class="invalid-feedback">
                <strong>{{ $errors->first('path') }}</strong>
            </div>

        @endif
    </div>
</div>
<div class="form-group">
    <label for="content-en">{{ __('backend.content_en') }}</label>
    <textarea id="content-en" name="content_en" rows="5" required
              class="form-control {{ $errors->has('content_en') ? 'is-invalid' : '' }}">{{ old('content_en', $page->content_en) }}</textarea>

    @if($errors->has('content_en'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('content_en') }}</strong>
        </div>

    @endif
</div>
<div class="form-group">
    <label for="content-ru">{{ __('backend.content_ru') }}</label>
    <textarea id="content-ru" name="content_ru" rows="5" required
              class="form-control {{ $errors->has('content_ru') ? 'is-invalid' : '' }}">{{ old('content_ru', $page->content_ru) }}</textarea>

    @if($errors->has('content_ru'))
        <div class="invalid-feedback">
            <strong>{{ $errors->first('content_ru') }}</strong>
        </div>

    @endif
</div>
<hr>
<div class="form-group bg-light p-3 border border-secondary">
    <p class="lead text-center">Search engine optimization &mdash;&nbsp;Поисковая оптимизация&nbsp;(SEO)</p>
    <label for="seo-title">{{ __('backend.seo-title') }}</label>
    <input type="text" id="seo-title" name="seo[title]" value="{{ old('seo-title', $page->seo['title']) }}"
           class="form-control">
    <label for="seo-keywords">{{ __('backend.seo-keywords') }}</label>
    <input type="text" id="seo-keywords" name="seo[keywords]" value="{{ old('seo-keywords', $page->seo['keywords']) }}"
           class="form-control">
    <label for="seo-description">{{ __('backend.seo-description') }}</label>
    <input type="text" id="seo-description" name="seo[description]"
           value="{{ old('seo-description', $page->seo['description']) }}"
           class="form-control">
</div>

@section('script')
    <script type="text/javascript">

        $(document).ready(function() {
            let locale = "{{ language()->getLongCode() }}";
            console.log(locale);
            $('#content-en').summernote({
                height: 250,
                minHeight: 150,
                lang: locale,
            });
            $('#content-ru').summernote({
                height: 250,
                minHeight: 150,
                lang: locale,
            });
        });
    </script>
@endsection



