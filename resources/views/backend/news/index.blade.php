@php /** @var \Illuminate\Contracts\Pagination\LengthAwarePaginator $news */ @endphp

<x-backend-layout :title="__('backend.news')">
    <div class="card">
        <div class="card-header">
            <span class="h2 d-block">{{ __('backend.news') }}</span>
            <a href="{{ route('admin.news.create') }}" class="btn btn-success">{{ __('misc.create') }}</a>
        </div>
        @if($news->total())
            @include('backend.news.table')
            <div class="px-3">
                {{ $news->appends(request()->except('page'))->links() }}
            </div>

        @else
            <div class="card-body">
                <p>{{ __('backend.news-not-found') }}</p>
            </div>
        @endif
    </div>
</x-backend-layout>

