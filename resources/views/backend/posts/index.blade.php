@php /** @var \Illuminate\Contracts\Pagination\LengthAwarePaginator $posts */ @endphp

<x-backend-layout :title="__('backend.posts')">
    <div class="card">
        <div class="card-header">
            <span class="h2 d-block">{{ __('backend.posts') }}</span>
        </div>
        @if($posts->total())
            @include('backend.posts.table')
            <div class="px-3">
                {{ $posts->appends(request()->except('page'))->links() }}
            </div>

        @else
            <div class="card-body">
                <p>{{ __('backend.posts-not-found') }}</p>
            </div>
        @endif
    </div>
</x-backend-layout>

