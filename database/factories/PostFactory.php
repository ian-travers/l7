<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Blog\Post\Post;
use App\Entities\User;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    $title = $faker->sentence(4);

    return [
        'author_id' => User::find(1) ? 1 : function () {
            return factory(User::class)->create()->id;
        },
        'title' => $title,
        'slug' => Str::slug($title),
        'excerpt' => $faker->paragraph,
        'body' => $faker->paragraphs(4, true),
        'image' => null,
        'published_at' => null,
        'deleted_at' => null,
    ];
});
