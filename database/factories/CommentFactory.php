<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Comment;
use App\Entities\News\News;
use App\Entities\User;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'commentable_type' => News::class,
        'commentable_id' => factory(News::class)->create()->id,
        'user_id' => factory(User::class)->create()->id,
        'parent_id' => null,
        'body' => $faker->sentence,
    ];
});
