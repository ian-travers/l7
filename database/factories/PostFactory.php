<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Blog\Post\Post;
use App\Entities\User;
use Carbon\Carbon;
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
        'views_count' => 0,
        'image' => null,
        'published_at' => null,
        'deleted_at' => null,
    ];
});

$factory->state(Post::class, 'published', function () {
    return [
        'published_at' => Carbon::now()->subMinute(),
    ];
});
