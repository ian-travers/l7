@php /** @var \Illuminate\Contracts\Pagination\LengthAwarePaginator $questions */ @endphp

<x-backend-layout :title="__('backend.tests')">
    <div class="card">
        <div class="card-header">
            <span class="h2 d-block">{{ __('backend.tests.questions') }}</span>
            <a href="{{ route('admin.tests.questions.create') }}" class="btn btn-success">{{ __('misc.create') }}</a>
        </div>

        @if($questions->total())
            @include('backend.tests.questions.table')
            <div class="px-3">
                {{ $questions->appends(request()->except('page'))->links() }}
            </div>

        @else
            <div class="card-body">
                <p>{{ __('backend.tests.questions-not-found') }}</p>
            </div>
        @endif
    </div>
</x-backend-layout>

