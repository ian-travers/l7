<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entities\Page\Page;

$factory->define(Page::class, function () {
    return [
        'parent_id' => null,
        'path' => '/rules',
        'link_en' => 'Rules',
        'link_ru' => 'Правила',
        'title_en' => 'Rules of the NFSU Cup',
        'title_ru' => 'Правила проведения турниров NFSU Cup',
        'content_en' => 'Rules',
        'content_ru' => 'Правила',
        'seo' => null,
    ];
});
