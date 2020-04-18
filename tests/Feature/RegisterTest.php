<?php

namespace Tests\Feature;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function register_a_new_users_not_verifies_their_email()
    {
        /** @var User $user */
        $user = factory(User::class)->states('unverified')->create();

        $this->assertFalse($user->hasVerifiedEmail());
    }

    /** @test */
    function registration_requires_a_nickname()
    {
        $this->post(route('register'), make(User::class, ['nickname' => null])->toArray())
            ->assertSessionHasErrors('nickname');

        $this->assertEquals(0, User::count());
    }

    /** @test */
    function registration_requires_an_email()
    {
        $this->post(route('register'), make(User::class, ['email' => null])->toArray())
            ->assertSessionHasErrors('email');

        $this->assertEquals(0, User::count());
    }
}
