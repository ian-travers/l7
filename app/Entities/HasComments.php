<?php

namespace App\Entities;

use Illuminate\Contracts\Auth\Authenticatable;

trait HasComments
{
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable')->withCount('likes');
    }

    /**
     * Create a comment
     *
     * @param string $body
     * @param User|Authenticatable $author
     * @param int|null $parent_id
     *
     * @return Comment
     */
    public function comment(string $body, $author, $parent_id = null)
    {
        return Comment::createComment($this, $body, $author, $parent_id);
    }

    /**
     * Update a comment
     *
     * @param $id
     * @param $body
     *
     * @return bool
     */
    public function updateComment($id, $body)
    {
        return Comment::updateComment($id, $body);
    }

    /**
     * Delete a comment
     *
     * @param $id
     *
     * @return bool
     * @throws \Exception
     */
    public function deleteComment($id)
    {
        return Comment::deleteComment($id);
    }

    /**
     * The amount of comments assigned to this model
     *
     * @return int
     */
    public function commentsCount(): int
    {
        return $this->comments->count();
    }
}
