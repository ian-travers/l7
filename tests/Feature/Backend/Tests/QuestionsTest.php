<?php

namespace Tests\Feature\Backend;

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
    function users_cannot_manage_tests()
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
    function authenticated_user_can_create_a_question()
    {
        /** @var User $admin */
        $admin = create(User::class);

        $admin->setAdminRights();

        $this->signIn($admin);


        $question = [
            'question_en' => 'In English',
            'question_ru' => 'In Russian',
            'correct_answer' => '1',
        ];

        $this->post(route('admin.tests.questions.store', $question))
            ->assertRedirect(route('admin.tests.questions'));

        $this->assertDatabaseHas('test_questions', $question);
    }

    /** @test */
    function question_requires_en_text()
    {
        /** @var User $admin */
        $admin = create(User::class);

        $admin->setAdminRights();

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
        $admin = create(User::class);

        $admin->setAdminRights();

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
        $admin = create(User::class);

        $admin->setAdminRights();

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
