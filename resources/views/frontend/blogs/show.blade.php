@php  /** @var App\Entities\Blog\Post\Post $post */ @endphp

<x-frontend-layout :title="__('misc.blogs')">
    <div class="container text-info mt-n3">
        @if($post->hasImage())
            <div class="text-center">
                <img src="{{ asset($post->image) }}" alt="">
            </div>
        @endif
        <h2 class="text-center">{{ $post->title }}</h2>
        <div class="p-2 my-3 border-left border-6 border-info lead">
              <span class="ml-3 fas fa-calendar-alt"></span><span class="ml-2">{{ $post->published_at->toDateString() }}</span>
              <span class="ml-3 fas fa-user"></span><span class="ml-2">{{ $post->author->nickname }} {{ $post->author->name ? '(' . $post->author->name . ')' : '' }}</span>
            <span class="ml-3 fas fa-eye"></span><span class="ml-2">{{ $post->views_count }}</span>
            <span class="ml-3 fas fa-comments"></span><span class="ml-2">{{ $post->commentsCount() }}</span>
        </div>
        <div>
            {!! $post->body !!}
        </div>
    </div>
</x-frontend-layout>
