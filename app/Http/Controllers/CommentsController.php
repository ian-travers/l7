<?php

namespace App\Http\Controllers;

use App\Entities\Comment;
use Illuminate\Http\Response;

class CommentsController extends Controller
{
    use LikingDisliking;

    /**
     * @param Comment $comment
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Comment $comment)
    {
        $this->authorize('update', $comment);

        $comment->update($this->validate(request(), ['body' => 'required']));

        if (request()->wantsJson()) {
            return response([
                'status' => __('flash.success'),
                'message' => __('flash.updated'),
            ]);
        }

        return back()->with('flash', json_encode([
            'type' => 'success',
            'title' => __('flash.success'),
            'message' => __('flash.updated'),
        ]));
    }

    /**
     * @param Comment $comment
     *
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function remove(Comment $comment)
    {
        $this->authorize('update', $comment);

        if (request()->wantsJson()) {
            if ($comment->hasChild()) {
                return response([
                    'status' => __('flash.warning'),
                    'message' => __('flash.comment-edit-only'),
                ], Response::HTTP_UNPROCESSABLE_ENTITY);
            } else {
                $comment->delete();

                return response([
                    'status' => __('flash.success'),
                    'message' => __('flash.deleted'),
                ]);
            }
        }

        if ($comment->hasChild()) {
            return back()->with('flash', json_encode([
                'type' => 'warning',
                'title' => __('flash.warning'),
                'message' => __('flash.comment-edit-only'),
            ]));
        }

        $comment->delete();

        return back()->with('flash', json_encode([
            'type' => 'success',
            'title' => __('flash.success'),
            'message' => __('flash.comment-deleted'),
        ]));
    }

    public function like(Comment $comment)
    {
        return $this->storeLike($comment);
    }

    public function unlike(Comment $comment)
    {
        return $this->removeLike($comment);
    }

    public function dislike(Comment $comment)
    {
        return $this->storeDislike($comment);
    }

    public function undislike(Comment $comment)
    {
        return $this->removeDislike($comment);
    }
}
