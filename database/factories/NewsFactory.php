<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\News\News;
use App\Entities\User;
use Faker\Generator as Faker;

$factory->define(News::class, function (Faker $faker) {
    $title_en = $faker->sentence(4);

    return [
        'author_id' => function () {
            return factory(User::class)->states('admin')->create()->id;
        },
        'title_en' => $title_en,
        'title_ru' => 'Russian phrase ' . Str::uuid(),
        'slug' => Str::slug($title_en),
        'body_en' => $faker->paragraphs(4, true),
        'body_ru' => $faker->paragraphs(3, true),
        'status' => 0,
    ];
});
