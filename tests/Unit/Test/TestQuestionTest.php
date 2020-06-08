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

        $this->assertDatabaseHas('test_questions', $testQuestion->toArray());
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

        $this->assertDatabaseHas('test_questions', $testQuestion->toArray());
    }

    /** @test */
    function it_can_add_an_answer()
    {
        $testQuestion = TestQuestion::new('What is this?', 'Что?', 1);
        $testQuestion->addAnswer('Nothing', 'А ничего', 1);

        $this->assertCount(1, $testQuestion->answers);
        $this->assertDatabaseHas('test_answers', $testQuestion->answers()->first()->toArray());
    }

    /** @test */
    function it_can_edit_the_answer()
    {
        $testQuestion = TestQuestion::new('What is this?', 'Что?', 1);
        $testQuestion->addAnswer('Nothing', 'А ничего', 1);

        $this->assertCount(1, $testQuestion->answers);

        $answer = $testQuestion->answers()->first();
        $this->assertDatabaseHas('test_answers', $answer->toArray());

        $testQuestion->editAnswer($answer->id, 'It is', 'Это', 5);
        $this->assertDatabaseHas('test_answers', $answer->fresh()->toArray());

    }

    /** @test */
    function it_can_delete_the_answer()
    {
        $testQuestion = TestQuestion::new('What is this?', 'Что?', 1);
        $testQuestion->addAnswer('Nothing', 'А ничего', 1);

        $this->assertDatabaseHas('test_answers', $testQuestion->answers()->first()->toArray());

        $answer = $testQuestion->answers()->first();
        $testQuestion->removeAnswer($answer->id);

        $this->assertDatabaseMissing('test_answers', $answer->toArray());
    }

    /** @test */
    function it_gets_native_question()
    {
        /** @var TestQuestion $question */
        $question = make(TestQuestion::class);

        app()->setLocale('en');

        $this->assertEquals('English', $question->question);

        app()->setLocale('ru');

        $this->assertEquals('Русский', $question->question);
    }
}
