<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(User::class, function (Faker $faker) {
    return [
        'nickname' => $faker->word(),
        'name' => $faker->name,
        'locale' => 'en',
        'country' => 'US',
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'role' => 'user',
        'is_admin' => false,
        'remember_token' => Str::random(10),
    ];
});

$factory->state(User::class, 'unverified', function () {
    return [
        'email_verified_at' => null,
    ];
});

$factory->state(User::class, 'admin', function () {
    return [
        'is_admin' => true,
    ];
});
