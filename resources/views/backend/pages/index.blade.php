@php /** @var \Illuminate\Contracts\Pagination\LengthAwarePaginator $pages */ @endphp

<x-backend-layout :title="__('backend.pages')">
    <div class="card">
        <div class="card-header">
            <span class="h2 d-block">{{ __('backend.pages') }}</span>
            <a href="{{ route('admin.pages.create') }}" class="btn btn-success">{{ __('misc.create') }}</a>
        </div>

        @if($pages->total())
            @include('backend.pages.table')
            <div class="px-3">
                {{ $pages->appends(request()->except('page'))->links() }}
            </div>

        @else
            <div class="card-body">
                <p>{{ __('backend.pages-not-found') }}</p>
            </div>
        @endif
    </div>
</x-backend-layout>

