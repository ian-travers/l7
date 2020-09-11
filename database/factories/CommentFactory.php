<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Comment;
use App\Entities\News\News;
use App\Entities\User;

$factory->define(Comment::class, function () {
    return [
        'commentable_type' => News::class,
        'commentable_id' => factory(News::class)->create()->id,
        'user_id' => factory(User::class)->create()->id,
        'parent_id' => null,
        'body' => 'Comment here',
    ];
});
