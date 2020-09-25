<?php

namespace Tests\Feature\Backend;

use App\Entities\Test\TestQuestion;
use App\Entities\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class AnswersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function guests_cannot_manage_question_answers()
    {
        $this->get("/adm/tests/1")
            ->assertRedirect('/login');

        $this->get("/adm/tests/1/answers/create")
            ->assertRedirect('/login');

        $this->get("/adm/tests/1/answers/1/edit")
            ->assertRedirect('/login');
    }

    /** @test */
    function unauthorized_users_cannot_manage_question_answers()
    {
        /** @var TestQuestion $question */
        $question = create(TestQuestion::class);
        $question->addAnswer('En', 'Ru', '1');

        $this->signIn();

        $this->get("/adm/tests/{$question->id}/answers/create")
            ->assertRedirect('/')
            ->assertSessionHas('flash', json_encode([
                'type' => 'warning',
                'title' => __('flash.warning'),
                'message' => __('flash.not-enough-rights'),
            ]));

        $this->get("/adm/tests/{$question->id}/answers/{$question->answers->first()->id}/edit")
            ->assertRedirect('/')
            ->assertSessionHas('flash', json_encode([
                'type' => 'warning',
                'title' => __('flash.warning'),
                'message' => __('flash.not-enough-rights'),
            ]));

        $this->delete("/adm/tests/{$question->id}/answers/{$question->answers->first()->id}")
            ->assertRedirect('/')
            ->assertSessionHas('flash', json_encode([
                'type' => 'warning',
                'title' => __('flash.warning'),
                'message' => __('flash.not-enough-rights'),
            ]));
    }

    /** @test */
    function authorized_user_can_create_an_answer()
    {
        /** @var User $admin */
        $admin = factory(User::class)->states('admin')->create();
        $this->signIn($admin);

        $question = create(TestQuestion::class);

        $answer = [
            'answer_en' => 'en',
            'answer_ru' => 'ru',
            'index' => '1',
        ];

        $this->post("/adm/tests/{$question->id}/answers", $answer)
            ->assertRedirect(route('admin.tests.questions.show', $question));

        $this->assertDatabaseHas('test_answers', $answer);
    }

    /** @test */
    function authorized_user_can_edit_an_answer()
    {
        /** @var User $admin */
        $admin = factory(User::class)->states('admin')->create();
        $this->signIn($admin);

        /** @var TestQuestion $question */
        $question = create(TestQuestion::class);

        $answer = [
            'answer_en' => 'en',
            'answer_ru' => 'ru',
            'index' => '1',
        ];
        $question->addAnswer($answer['answer_en'], $answer['answer_ru'], $answer['index']);

        $this->assertDatabaseHas('test_answers', $answer);

        $updatedAnswer = [
            'answer_en' => 'en_upd',
            'answer_ru' => 'ru_upd',
            'index' => '2',
        ];

        $this->patch("/adm/tests/{$question->id}/answers/{$question->answers->first()->id}", $updatedAnswer)
            ->assertStatus(Response::HTTP_FOUND);

        $this->assertDatabaseMissing('test_answers', $answer);
        $this->assertDatabaseHas('test_answers', $updatedAnswer);
    }

    /** @test */
    function authorized_user_can_delete_an_answer()
    {
        /** @var User $admin */
        $admin = factory(User::class)->states('admin')->create();
        $this->signIn($admin);

        /** @var TestQuestion $question */
        $question = create(TestQuestion::class);

        $answer = [
            'answer_en' => 'en',
            'answer_ru' => 'ru',
            'index' => '1',
        ];
        $question->addAnswer($answer['answer_en'], $answer['answer_ru'], $answer['index']);

        $this->assertDatabaseHas('test_answers', $answer);

        $this->delete("/adm/tests/{$question->id}/answers/{$question->answers->first()->id}");

        $this->assertDatabaseMissing('test_answers', $answer);
    }

    /** @test */
    function answer_required_valid_english_text()
    {
        /** @var User $admin */
        $admin = factory(User::class)->states('admin')->create();
        $this->signIn($admin);

        /** @var TestQuestion $question */
        $question = create(TestQuestion::class);

        $answer = [
            'answer_en' => '',
            'answer_ru' => 'ru',
            'index' => '1',
        ];

        $this->post("/adm/tests/{$question->id}/answers", $answer)
            ->assertSessionHasErrors('answer_en');

        $this->assertDatabaseMissing('test_answers', $answer);
    }

    /** @test */
    function answer_required_valid_russian_text()
    {
        /** @var User $admin */
        $admin = factory(User::class)->states('admin')->create();
        $this->signIn($admin);

        /** @var TestQuestion $question */
        $question = create(TestQuestion::class);

        $answer = [
            'answer_en' => 'en',
            'answer_ru' => '',
            'index' => '1',
        ];

        $this->post("/adm/tests/{$question->id}/answers", $answer)
            ->assertSessionHasErrors('answer_ru');

        $this->assertDatabaseMissing('test_answers', $answer);
    }

    /** @test */
    function answer_required_valid_index()
    {
        /** @var User $admin */
        $admin = factory(User::class)->states('admin')->create();
        $this->signIn($admin);

        /** @var TestQuestion $question */
        $question = create(TestQuestion::class);

        $answer = [
            'answer_en' => 'en',
            'answer_ru' => 'ru',
            'index' => '10', // might be 1-9
        ];

        $this->post("/adm/tests/{$question->id}/answers", $answer)
            ->assertSessionHasErrors('index');

        $this->assertDatabaseMissing('test_answers', $answer);
    }
}
