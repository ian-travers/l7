<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Test\TestAnswer;

$factory->define(TestAnswer::class, function () {
    return [
        'answer_en' => 'English',
        'answer_ru' => 'Русский',
        'index' => '1',
    ];
});
