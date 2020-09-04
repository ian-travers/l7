<?php

namespace App\Entities;

class CommentView
{
    /**
     * @var Comment
     */
    public $comment;
    /**
     * @var self[]
     */
    public $children;

    public function __construct(Comment $comment, array $children)
    {
        $this->comment = $comment;
        $this->children = $children;
    }
}
