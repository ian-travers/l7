@php  /** @var App\Entities\Blog\Post\Post $post */ @endphp

<x-frontend-layout :title="__('misc.blogs')">
    <div class="container-fluid text-info mt-n3">
        <h2 class="text-center">{{ $post->title }}</h2>
    </div>
</x-frontend-layout>
