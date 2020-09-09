<?php

namespace App\Policies\Comments;

use App\Entities\Comment;
use App\Entities\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CommentPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the comment.
     *
     * @param \App\Entities\User $user
     * @param \App\Entities\Comment $comment
     * @return mixed
     */
    public function update(User $user, Comment $comment)
    {
        return $comment->user_id == $user->id;
    }
}
