<?php

namespace App\Http\Controllers;

use App\Entities\Comment;

class LikesController extends Controller
{
    public function store(Comment $comment)
    {
        $comment->like();

        return back()->with('flash', json_encode([
            'type' => 'success',
            'title' => __('flash.success'),
            'message' => __('flash.mark-liked'),
        ]));
    }
}
