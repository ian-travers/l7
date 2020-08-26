@php  /** @var App\Entities\Blog\Post\Post $post */ @endphp

<x-frontend-layout :title="__('misc.blogs')">
    <div class="container-fluid text-info mt-n3">
        @if($post->hasImage())
            <div class="text-center">
                <img src="{{ asset($post->image) }}" alt="">
            </div>
        @endif
        <h2 class="text-center">{{ $post->title }}</h2>
        <div>
{{--            {!! $post->body !!}--}}
            @php echo $post->body @endphp
        </div>
    </div>
</x-frontend-layout>
