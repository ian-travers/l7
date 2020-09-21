<?php

namespace App\Http\Controllers;

use App\Entities\Comment;

class LikesController extends Controller
{
    public function store(Comment $comment)
    {
        $comment->like();

        return response([
            'status' => __('flash.info'),
            'message' => __('flash.mark-liked'),
        ]);
    }

    public function remove(Comment $comment)
    {
        $comment->unlike();

        return response([
            'status' => __('flash.info'),
            'message' => __('flash.unmark-liked'),
        ]);
    }
}
