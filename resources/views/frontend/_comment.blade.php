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
                @auth
                    @if($commentView->comment->author->id == auth()->id())
                        <div class="comment-actions dropdown navbar-dark">
                            <span class="fas fa-ellipsis-v" type="button" data-toggle="dropdown"></span>
                            <div class="dropdown-menu dropdown-menu-right bg-nfsu-cup border border-light">
                                <div class="navbar-nav">
                                    <button class="dropdown-item dropdown-nfsu nav-link-nfsu">{{ __('misc.edit') }}</button>
                                    <form method="post" action="{{ route('comments.delete', $commentView->comment) }}">
                                        @csrf
                                        @method('delete')
                                        <button class="dropdown-item dropdown-nfsu nav-link-nfsu">{{ __('misc.delete') }}</button>
                                    </form>
                                </div>

                            </div>
                        </div>
                    @else
                        <div class="comment-reply">
                            <span class="fas fa-reply"></span>
                            {{ __('misc.reply') }}
                        </div>
                    @endif
                @endauth
            </div>
            <div>{{ $commentView->comment->body }}</div>
        </div>
    </div>
    <div class="reply-block"></div>
    @foreach($commentView->children as $child)
        @include('frontend._comment', ['commentView' => $child])
    @endforeach
</div>

