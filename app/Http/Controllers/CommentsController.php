<?php

namespace App\Http\Controllers;

use App\Entities\Comment;

class CommentsController extends Controller
{
    /**
     * @param Comment $comment
     *
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Comment $comment)
    {
        $this->authorize('update', $comment);

        $comment->update($this->validate(request(), ['body' => 'required']));
    }
}
