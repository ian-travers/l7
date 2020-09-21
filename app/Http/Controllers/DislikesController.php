<?php

namespace App\Http\Controllers;

use App\Entities\Comment;

class DislikesController extends Controller
{
    public function store(Comment $comment)
    {
        $comment->dislike();

        return response([
            'status' => __('flash.info'),
            'message' => __('flash.mark-disliked'),
        ]);
    }

    public function remove(Comment $comment)
    {
        $comment->undislike();

        return response([
            'status' => __('flash.info'),
            'message' => __('flash.unmark-disliked'),
        ]);
    }
}
