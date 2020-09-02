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

        <h3 class="border-top border-info pt-3">{{ __('misc.comments') }}</h3>
        @forelse($news->comments as $comment)
            <div class="comment-item border border-info mb-3 px-3 py-1">
                <div class="d-flex">
                    <div class="author-avatar py-3 mr-3">
                        @if($comment->author->hasAvatar())
                            <img src="{{ asset($comment->author->avatar_path) }}" class="rounded-circle"
                                 width="50" height="50" alt="">
                        @else
                            <div style="width: 50px"></div>
                        @endif
                    </div>
                    <div class="text-info">
                        <p>
                            <strong>{{ $comment->author->nickname }}</strong>
                            <span class="text-muted">{{ $comment->created_at->diffForHumans() }}</span>
                        </p>
                        <div>{{ $comment->body }}</div>
                    </div>
                </div>
            </div>
        @empty
            <p>{{ __('misc.no-comments-yet') }}</p>
        @endforelse

        @guest
            <div class="text-center">{!! __('misc.login-to-comment') !!}</div>
        @else
            <form action="{{ route('news.comment', $news->slug) }}" method="post">
                @csrf
                @include('frontend._commentForm')
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-sm">{{ __('misc.comment') }}</button>
                </div>
            </form>
        @endguest
    </div>
</x-frontend-layout>
