<?php

namespace App\Http\Controllers;

use App\Entities\Comment;

class DislikesController extends Controller
{
    public function store(Comment $comment)
    {
        $comment->dislike();

        return back()->with('flash', json_encode([
            'type' => 'success',
            'title' => __('flash.success'),
            'message' => __('flash.mark-disliked'),
        ]));
    }

    public function remove(Comment $comment)
    {
        $comment->undislike();

        return back()->with('flash', json_encode([
            'type' => 'success',
            'title' => __('flash.success'),
            'message' => __('flash.unmark-disliked'),
        ]));
    }
}
