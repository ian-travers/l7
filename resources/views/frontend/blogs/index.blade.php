@php  /** @var App\Entities\Blog\Post\Post $post */ @endphp

<x-frontend-layout :title="__('misc.blogs')">
    <posts inline-template>
        <div class="container text-info mt-n3">
            @forelse($posts as $post)
                <div class="mb-3 border border-info p-3 mb-3">

                    <div class="row">
                        <div class="col-md-2">
                            @if($post->hasImage())
                                <div class="post-image">
                                    <a href="{{ route('blogs.show', $post->slug) }}">
                                        <img id="p-img" src="{{ asset($post->image) }}" alt="">
                                    </a>
                                </div>
                            @endif
                        </div>
                        <div
                            class="col-md-10 d-flex flex-column justify-content-between border-left border-info my-n3 py-3">
                            <div class="lead">
                                <a href="{{ route('blogs.show', $post->slug) }}" class="link-text-info h2 clearfix">{{ $post->title }}</a>
                                {{ $post->excerpt }}
                            </div>
                            <div class="pt-3 border-top border-info mx-n3 px-3">
                                <span class="fas fa-eye mr-2"></span><span class="mr-3">{{ $post->views_count }}</span>
                                <span class="fas fa-user-alt mr-2"></span><span
                                    class="mr-3">{{ $post->author->nickname }}</span>
                                <span class="fas fa-calendar-alt mr-2"></span><span
                                    class="mr-3">{{ $post->published() ? $post->published_at->diffForHumans() : '' }}</span>
                                <like-dislike
                                    :model="{{ $post }}"
                                    uri-suffix="blogs"
                                ></like-dislike>
                                <span class="fas fa-comments mr-2 ml-5"></span><span class="mr-3">{{ $post->comments_count }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                {{ __('backend.posts-not-found') }}
            @endforelse
            <div class="text-center">
                {{ $posts->links() }}
            </div>
        </div>
    </posts>
</x-frontend-layout>
