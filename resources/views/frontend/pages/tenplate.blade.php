@php /* @var App\Entities\Page\Page $page */ @endphp

<x-frontend-layout :title="$page->title">
    <div class="container text-info">
        {!! $page->content !!}
        <p class="text-right pt-3 border-top border-info">{{ $page->created_at->format('d.m.Y') }}</p>
    </div>
</x-frontend-layout>

