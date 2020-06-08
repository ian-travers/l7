<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Test\TestQuestion;

$factory->define(TestQuestion::class, function () {
    return [
        'question_en' => 'English',
        'question_ru' => 'Русский',
        'correct_answer' => '1',
    ];
});
