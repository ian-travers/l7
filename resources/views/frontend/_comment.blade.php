@php /** @var App\Entities\CommentView $commentView */ @endphp

<div class="comment-item border border-info mb-1 px-3 py-1" data-id="{{ $commentView->comment->id }}">
    <div class="d-flex">
        <div class="author-avatar py-3 mr-3">
            @if($commentView->comment->author->hasAvatar())
                <img src="{{ asset($commentView->comment->author->avatar_path) }}" class="rounded-circle"
                     width="50" height="50" alt="">
            @else
                <div style="width: 50px"></div>
            @endif
        </div>
        <div class="text-info w-100">
            <div class="d-flex justify-content-between">
                <div>
                    <strong>{{ $commentView->comment->author->nickname }}</strong>
                    <span class="text-muted">{{ $commentView->comment->created_at->diffForHumans() }}</span>
                </div>
                <div class="comment-reply">
                    <span class="fas fa-reply"></span>
                    {{ __('misc.reply') }}
                </div>
            </div>
            <div>{{ $commentView->comment->body }}</div>
        </div>
    </div>
    <div class="reply-block"></div>
    @foreach($commentView->children as $child)
        @include('frontend._comment', ['commentView' => $child])
    @endforeach
</div>

