<?php

namespace App\Http\Controllers;

use App\Entities\Comment;

class LikesController extends Controller
{
    public function store(Comment $comment)
    {
        return $comment->like();
    }
}
