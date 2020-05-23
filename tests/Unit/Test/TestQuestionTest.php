<?php

namespace Tests\Unit\Test;

use App\Entities\Test\TestQuestion;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TestQuestionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function new_one_can_be_created()
    {
        $testQuestion = TestQuestion::new('What is this?', 'Что?', 1);

        $this->assertEquals('What is this?', $testQuestion->question_en);
        $this->assertEquals('Что?', $testQuestion->question_ru);
        $this->assertEquals(1, $testQuestion->correct_answer);
    }

    /** @test */
    function it_can_be_edited()
    {
        $testQuestion = TestQuestion::new('What is this?', 'Что?', 1);

        $this->assertEquals('What is this?', $testQuestion->question_en);
        $this->assertEquals('Что?', $testQuestion->question_ru);
        $this->assertEquals(1, $testQuestion->correct_answer);

        $testQuestion->edit('What happened?', 'Кто?', 2);

        $this->assertEquals('What happened?', $testQuestion->question_en);
        $this->assertEquals('Кто?', $testQuestion->question_ru);
        $this->assertEquals(2, $testQuestion->correct_answer);
    }
}
