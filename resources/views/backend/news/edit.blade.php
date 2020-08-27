@php /* @var \App\Entities\News\News $new */ @endphp

<x-backend-layout :title="__('backend.edit-news')">
    <div class="card">
        <div class="card-header">
            <span class="h3 d-block">{{ __('backend.edit-news') }}</span>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.news.update', $news) }}" method="post">
                @csrf
                @method('patch')
                @include('backend.news._form')
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">{{ __('misc.update') }}</button>
                </div>
            </form>
        </div>
    </div>
</x-backend-layout>

