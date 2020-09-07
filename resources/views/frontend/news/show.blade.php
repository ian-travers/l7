@php
    /**
      * @var App\Entities\News\News $news
      * @var App\Entities\CommentView $commentView
      */
@endphp

<x-frontend-layout :title="__('misc.news')">
    <div class="container text-info mt-n3">
        <h2 class="text-center">{{ $news->title }}</h2>
        <div class="p-2 my-3 border-left border-4 border-info">
            <span class="ml-3 fas fa-calendar-alt"></span>
            {{ $news->created_at->toDateString() }}
            <span class="ml-3 fas fa-comments"></span>
            {{ $news->commentsCount() }}
        </div>
        <div>
            {!! $news->body !!}
        </div>

        <h3 class="border-top border-info pt-3">{{ __('misc.comments') }}</h3>
        <div id="comments">
            @forelse($commentViews as $commentView)
                @include('frontend._comment')
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
                document.getElementById('cancel-reply').style.display = 'inline-block';
                return false;
            });
            $(document).on('click', '#comments #cancel-reply', function () {
                let form = $('#reply-block');
                $('#parent-id').removeAttr('value');
                form.detach().appendTo('#root-level');
                document.getElementById('cancel-reply').style.display = 'none';
                return false;
            });
        </script>
    @endsection
</x-frontend-layout>
