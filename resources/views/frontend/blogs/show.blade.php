@php  /** @var App\Entities\Blog\Post\Post $post */ @endphp

<x-frontend-layout :title="__('misc.blogs')">
    <post :initial-comments-count="{{ $post->comments_count }}" inline-template>
        <div class="container text-info mt-n3">
            @if($post->hasImage())
                <div class="text-center">
                    <img src="{{ asset($post->image) }}" alt="">
                </div>
            @endif
            <h2 class="text-center">{{ $post->title }}</h2>
            <div class="p-2 my-3 border-left border-6 border-info lead">
                <span class="ml-3 fas fa-calendar-alt"></span><span
                    class="ml-2">{{ $post->published_at->toDateString() }}</span>
                <span class="ml-3 fas fa-user"></span><span
                    class="ml-2">{{ $post->author->nickname }} {{ $post->author->name ? '(' . $post->author->name . ')' : '' }}</span>
                <span class="ml-3 fas fa-eye"></span><span class="ml-2">{{ $post->views_count }}</span>
                <like-dislike
                    :model="{{ $post }}"
                    uri-suffix="blogs"
                ></like-dislike>
                <span class="ml-5 fas fa-comments"></span><span class="ml-2" v-text="commentsCount"></span>
            </div>
            <div>
                {!! $post->body !!}
            </div>

            <h3 class="border-top border-info pt-3">{{ __('misc.comments') }}</h3>
            <div id="comments">
                @if($post->comments_count)
                    <comments
                        :data="{{ json_encode($commentViews) }}"
                        reply="{{ __('misc.reply') }}"
                        edit="{{ __('misc.edit') }}"
                        update="{{ __('misc.update') }}"
                        cancel="{{ __('misc.cancel') }}"
                        del="{{ __('misc.delete') }}"
                        @removed="commentsCount--"
                    ></comments>
                @else
                    <p>{{ __('misc.no-comments-yet') }}</p>
                @endif
            </div>
            <div id="root-level"></div>
            @guest
                <div class="text-center">{!! __('misc.login-to-comment') !!}</div>
            @else
                <div id="reply-block">
                    <form action="{{ route('blogs.comment', $post->slug) }}" method="post">
                        @csrf
                        @include('frontend._commentForm')
                        <input id="parent-id" type="hidden" name="parent_id">
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-sm">{{ __('misc.comment') }}</button>
                            <div id="cancel-reply" class="pull-right ml-3">
                                <a href="#">{{ __('misc.cancel') }}</a>
                            </div>
                        </div>
                    </form>
                </div>
            @endguest
        </div>
        @include('frontend._commentJs')
    </post>
</x-frontend-layout>
