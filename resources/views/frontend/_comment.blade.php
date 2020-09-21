@php
    /** @var App\Entities\CommentView $commentView */
    /** @var App\Entities\Comment $comment */

    $comment = $commentView->comment;
@endphp

<comment
    :attributes="{{ $comment }}"
    inline-template
    v-cloak>
    <div class="comment-item border border-info mb-1 px-3 py-1" data-id="{{ $comment->id }}">
        <div class="d-flex">
            <div class="author-avatar py-3 mr-3">
                @php @endphp
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
                        @auth()
                            <like-dislike
                                :model="{{ $comment }}"
                                uri-suffix="comments"
                            ></like-dislike>
                        @endauth
                    </div>
                    @auth
                        @if($comment->author->id == auth()->id())
                            <div class="comment-actions dropdown navbar-dark">
                                <span class="fas fa-ellipsis-v" type="button" data-toggle="dropdown"></span>
                                <div class="dropdown-menu dropdown-menu-right bg-nfsu-cup border border-light">
                                    <div class="navbar-nav">
                                        <button class="dropdown-item dropdown-nfsu nav-link-nfsu"
                                                @click="editing = true">{{ __('misc.edit') }}</button>
                                        <button class="dropdown-item dropdown-nfsu nav-link-nfsu"
                                                @click="remove">{{ __('misc.delete') }}</button>
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
                <div class="py-1">
                    <div v-if="editing" class="form-group">
                        <textarea v-model="body" class="form-control bg-dark text-info mb-2" rows="3"
                                  required></textarea>
                        <button type="button" class="btn btn-sm btn-primary mr-1"
                                @click="update">{{ __('misc.update') }}</button>
                        <button type="button" class="btn btn-sm btn-secondary"
                                @click="editing = false">{{ __('misc.cancel') }}</button>
                    </div>
                    <div v-else v-text="body"></div>
                </div>
            </div>
        </div>
        <div class="reply-block"></div>
        @foreach($commentView->children as $child)
            @include('frontend._comment', ['commentView' => $child])
        @endforeach
    </div>
</comment>


