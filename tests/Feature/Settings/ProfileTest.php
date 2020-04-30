<?php

namespace Tests\Feature\Settings;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function user_can_update_profile()
    {
        $this->withoutExceptionHandling();
        /** @var User $user */
        $user = create(User::class);
        $this->signIn($user);

        $this->post('/settings/profile', ['nickname' => 'NEED4FUN', 'name' => 'Jane Doe', 'country' => 'US']);

        $this->assertEquals('NEED4FUN', $user->nickname);
        $this->assertEquals('Jane Doe', $user->name);
        $this->assertEquals('US', $user->country);
    }

    /** @test */
    function nickname_length_must_be_at_least_3_characters()
    {
        /** @var User $user */
        $user = create(User::class);
        $this->signIn($user);

        $this->post('/settings/profile', ['nickname' => 'jo'])
            ->assertSessionHasErrors('nickname');
    }

    /** @test */
    function nickname_length_must_be_less_16_characters()
    {
        /** @var User $user */
        $user = create(User::class);
        $this->signIn($user);

        $this->post('/settings/profile', ['nickname' => 'too-long-nickname'])
            ->assertSessionHasErrors('nickname');
    }

    /** @test */
    function nickname_consists_of_digits_and_letters_only()
    {
        /** @var User $user */
        $user = create(User::class);
        $this->signIn($user);

        $this->post('/settings/profile', ['nickname' => 'wrong nick'])
            ->assertSessionHasErrors('nickname');
        $this->post('/settings/profile', ['nickname' => 'wrong.nick'])
            ->assertSessionHasErrors('nickname');
        $this->post('/settings/profile', ['nickname' => 'wrong,nick'])
            ->assertSessionHasErrors('nickname');
        $this->post('/settings/profile', ['nickname' => 'wrong#nick'])
            ->assertSessionHasErrors('nickname');
        $this->post('/settings/profile', ['nickname' => 'wrong%nick'])
            ->assertSessionHasErrors('nickname');
        $this->post('/settings/profile', ['nickname' => 'wrong$nick'])
            ->assertSessionHasErrors('nickname');
        $this->post('/settings/profile', ['nickname' => 'wrong*nick'])
            ->assertSessionHasErrors('nickname');
        $this->post('/settings/profile', ['nickname' => 'wrong^nick'])
            ->assertSessionHasErrors('nickname');
        $this->post('/settings/profile', ['nickname' => 'wrong`nick'])
            ->assertSessionHasErrors('nickname');
        $this->post('/settings/profile', ['nickname' => 'wrong~nick'])
            ->assertSessionHasErrors('nickname');
        $this->post('/settings/profile', ['nickname' => 'wrong!nick'])
            ->assertSessionHasErrors('nickname');
        $this->post('/settings/profile', ['nickname' => 'wrong=nick'])
            ->assertSessionHasErrors('nickname');
        $this->post('/settings/profile', ['nickname' => 'wrong-nick'])
            ->assertSessionHasErrors('nickname');
        $this->post('/settings/profile', ['nickname' => 'wrong&nick'])
            ->assertSessionHasErrors('nickname');
        $this->post('/settings/profile', ['nickname' => 'wrong@nick'])
            ->assertSessionHasErrors('nickname');
        $this->post('/settings/profile', ['nickname' => 'wrong?nick'])
            ->assertSessionHasErrors('nickname');
        $this->post('/settings/profile', ['nickname' => 'wrong(nick'])
            ->assertSessionHasErrors('nickname');
        $this->post('/settings/profile', ['nickname' => 'wrong)nick'])
            ->assertSessionHasErrors('nickname');
        $this->post('/settings/profile', ['nickname' => 'wrong+nick'])
            ->assertSessionHasErrors('nickname');
        $this->post('/settings/profile', ['nickname' => 'wrong/nick'])
            ->assertSessionHasErrors('nickname');
        $this->post('/settings/profile', ['nickname' => 'wrong\nick'])
            ->assertSessionHasErrors('nickname');
        $this->post('/settings/profile', ['nickname' => 'wrong|nick'])
            ->assertSessionHasErrors('nickname');
        $this->post('/settings/profile', ['nickname' => 'wrong\'nick'])
            ->assertSessionHasErrors('nickname');
        $this->post('/settings/profile', ['nickname' => 'wrong"nick'])
            ->assertSessionHasErrors('nickname');
    }

    /** @test */
    function nickname_must_be_unique()
    {
        create(User::class, ['nickname' => 'john']);

        /** @var User $user */
        $user = create(User::class);
        $this->signIn($user);

        $this->post('/settings/profile', ['nickname' => 'john'])
            ->assertSessionHasErrors('nickname');
    }
}
