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

    /**
     * @param Comment $comment
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function remove(Comment $comment)
    {
        $this->authorize('update', $comment);

        $comment->delete();

        return back()->with('flash', json_encode([
            'type' => 'success',
            'title' => __('flash.success'),
            'message' => __('flash.comment-deleted'),
        ]));
    }
}