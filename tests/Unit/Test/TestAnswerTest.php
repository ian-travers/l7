<?php

namespace Tests\Unit\Test;

use App\Entities\Test\TestAnswer;
use Tests\TestCase;

class TestAnswerTest extends TestCase
{
    /** @test */
    function it_gets_native_question()
    {
        /** @var TestAnswer $answer */
        $answer = make(TestAnswer::class);

        app()->setLocale('en');

        $this->assertEquals('English', $answer->answer);

        app()->setLocale('ru');

        $this->assertEquals('Русский', $answer->answer);
    }
}
