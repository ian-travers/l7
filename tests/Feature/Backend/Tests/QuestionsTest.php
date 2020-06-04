<?php

namespace Tests\Feature\Backend;

use App\Entities\Test\TestQuestion;
use App\Entities\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class QuestionsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function guests_cannot_manage_tests()
    {
        $this->get('/adm/tests')
            ->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect('/login');

        $this->get('/adm/tests/create')
            ->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect('/login');
    }

    /** @test */
    function unauthorized_users_cannot_add_test_question()
    {
        $this->signIn();

        $this->get('/adm/tests')
            ->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect('/')
            ->assertSessionHas('flash', json_encode([
                'type' => 'warning',
                'title' => __('flash.warning'),
                'message' => __('flash.not-enough-rights'),
            ]));

        $this->get('/adm/tests/create')
            ->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect('/')
            ->assertSessionHas('flash', json_encode([
                'type' => 'warning',
                'title' => __('flash.warning'),
                'message' => __('flash.not-enough-rights'),
            ]));
    }

    /** @test */
    function unauthorized_users_cannot_edit_test_question()
    {
        $this->signIn();

        $question = create(TestQuestion::class);

        $this->get("/adm/tests/{$question->id}/edit", $question->toArray())
            ->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect('/')
            ->assertSessionHas('flash', json_encode([
                'type' => 'warning',
                'title' => __('flash.warning'),
                'message' => __('flash.not-enough-rights'),
            ]));
    }

    /** @test */
    function unauthorized_users_cannot_delete_test_question()
    {
        $this->signIn();

        $question = create(TestQuestion::class);

        $this->delete("/adm/tests/{$question->id}", $question->toArray())
            ->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect('/')
            ->assertSessionHas('flash', json_encode([
                'type' => 'warning',
                'title' => __('flash.warning'),
                'message' => __('flash.not-enough-rights'),
            ]));

        $this->assertDatabaseHas('test_questions', $question->toArray());
    }

    /** @test */
    function authorized_user_can_create_a_question()
    {
        /** @var User $admin */
        $admin = factory(User::class)->states('admin')->create();
        $this->signIn($admin);

        $question = make(TestQuestion::class);

        $this->post(route('admin.tests.questions.store', $question->toArray()))
            ->assertRedirect(route('admin.tests.questions'));

        $this->assertDatabaseHas('test_questions', $question->toArray());
    }

    /** @test */
    function authorized_user_can_edit_a_question()
    {
        /** @var User $admin */
        $admin = factory(User::class)->states('admin')->create();
        $this->signIn($admin);

        /** @var TestQuestion $question */
        $question = create(TestQuestion::class);

        $question->question_en = 'New en';
        $question->question_ru = 'New ru';
        $question->correct_answer = '2';

        $this->patch("/adm/tests/{$question->id}", $question->toArray())
            ->assertStatus(Response::HTTP_FOUND);

        $question = $question->fresh();

        $this->assertEquals('New en', $question->question_en);
        $this->assertEquals('New ru', $question->question_ru);
        $this->assertEquals('2', $question->correct_answer);
        $this->assertDatabaseHas('test_questions', $question->toArray());
    }

    /** @test */
    function authorized_user_can_delete_a_question()
    {
        /** @var User $admin */
        $admin = factory(User::class)->states('admin')->create();
        $this->signIn($admin);

        /** @var TestQuestion $question */
        $question = create(TestQuestion::class);

        $this->delete("/adm/tests/{$question->id}", $question->toArray())
            ->assertStatus(Response::HTTP_FOUND);

        $this->assertDatabaseMissing('test_questions', $question->toArray());
    }

    /** @test */
    function question_requires_en_text()
    {
        /** @var User $admin */
        $admin = factory(User::class)->states('admin')->create();
        $this->signIn($admin);

        $question = [
            'question_en' => null,
            'question_ru' => 'In Russian',
            'correct_answer' => '1',
        ];

        $this->post(route('admin.tests.questions.store', $question))
            ->assertSessionHasErrors('question_en');
        $this->assertDatabaseMissing('test_questions', $question);
    }

    /** @test */
    function question_requires_ru_text()
    {
        /** @var User $admin */
        $admin = factory(User::class)->states('admin')->create();
        $this->signIn($admin);

        $question = [
            'question_en' => 'In English',
            'question_ru' => null,
            'correct_answer' => '1',
        ];

        $this->post(route('admin.tests.questions.store', $question))
            ->assertSessionHasErrors('question_ru');
        $this->assertDatabaseMissing('test_questions', $question);
    }

    /** @test */
    function question_requires_correct_answer()
    {
        /** @var User $admin */
        $admin = factory(User::class)->states('admin')->create();
        $this->signIn($admin);

        $question = [
            'question_en' => 'In English',
            'question_ru' => 'In Russian',
            'correct_answer' => null,
        ];

        $this->post(route('admin.tests.questions.store', $question))
            ->assertSessionHasErrors('correct_answer');
        $this->assertDatabaseMissing('test_questions', $question);

        $question['correct_answer'] = '10'; //must be from 1 to 9

        $this->post(route('admin.tests.questions.store', $question))
            ->assertSessionHasErrors('correct_answer');
        $this->assertDatabaseMissing('test_questions', $question);
    }
}
