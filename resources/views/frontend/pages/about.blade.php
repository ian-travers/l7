@php /* @var App\Entities\Page\Page $page */ @endphp
<x-frontend-layout :title="__('pages.about')">
    <div class="container text-info">
        {!! $page->content !!}
    </div>
</x-frontend-layout>

