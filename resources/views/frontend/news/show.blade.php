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
        <div id="comments">
            @forelse($news->comments as $comment)
                <div class="comment-item border border-info mb-3 px-3 py-1" data-id="{{ $comment->id }}">
                    <div class="d-flex">
                        <div class="author-avatar py-3 mr-3">
                            @if($comment->author->hasAvatar())
                                <img src="{{ asset($comment->author->avatar_path) }}" class="rounded-circle"
                                     width="50" height="50" alt="">
                            @else
                                <div style="width: 50px"></div>
                            @endif
                        </div>
                        <div class="text-info w-100">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <strong>{{ $comment->author->nickname }}</strong>
                                    <span class="text-muted">{{ $comment->created_at->diffForHumans() }}</span>
                                </div>
                                <div class="comment-reply">
                                    <span class="fas fa-reply"></span>
                                    {{ __('misc.reply') }}
                                </div>
                            </div>
                            <div>{{ $comment->body }}</div>
                        </div>
                    </div>
                    <div class="ml-3">
                        <div class="reply-block"></div>
                    </div>
                </div>
            @empty
                <p>{{ __('misc.no-comments-yet') }}</p>
            @endforelse
        </div>
        <div id="root-level"></div>

        @guest
            <div class="text-center">{!! __('misc.login-to-comment') !!}</div>
        @else
            <div id="reply-block">
                <form action="{{ route('news.comment', $news->slug) }}" method="post">
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

    @section('script')
        <script type="text/javascript">
            $(document).on('click', '#comments .comment-reply', function () {
                let link = $(this);
                let form = $('#reply-block');
                let comment = link.closest('.comment-item');
                $('#parent-id').val(comment.data('id'));
                form.detach().appendTo(comment.find('.reply-block:first'));
                document.getElementById('cancel-reply').style.display='inline-block';
                return false;
            });
            $(document).on('click', '#comments #cancel-reply', function () {
                let form = $('#reply-block');
                $('#parent-id').removeAttr('value');
                form.detach().appendTo('#root-level');
                document.getElementById('cancel-reply').style.display='none';
                return false;
            });
        </script>
    @endsection
</x-frontend-layout>
