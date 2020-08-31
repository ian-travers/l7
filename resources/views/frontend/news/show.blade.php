@php  /** @var App\Entities\News\News $news */ @endphp

<x-frontend-layout :title="__('misc.news')">
    <div class="container text-info mt-n3">
        <h2 class="text-center">{{ $news->title }}</h2>
        <p>
            <span class="fas fa-calendar-alt"></span>
            {{ $news->created_at->toDateString() }}
        </p>
        <div>
            {!! $news->body !!}
        </div>
    </div>
</x-frontend-layout>
