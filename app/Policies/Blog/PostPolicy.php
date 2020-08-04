<?php

namespace App\Policies\Blog;

use App\Entities\Blog\Post\Post;
use App\Entities\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PostPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the post.
     *
     * @param  \App\Entities\User  $user
     * @param  \App\Entities\Blog\Post\Post $post
     * @return mixed
     */
    public function update(User $user, Post $post)
    {
        return $post->author_id == $user->id;
    }
}
