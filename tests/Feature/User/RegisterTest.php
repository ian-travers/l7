<?php

namespace Tests\Feature\User;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function guest_can_register_an_account_with_valid_form_data()
    {
        $user = [
            'nickname' => 'first',
            'email' => 'first@tasd.com',
            'country' => 'US',
            'locale' => 'en',
            'password' => '12345678',
            'password_confirmation' => '12345678',
        ];

        $this->post('/register', $user)
            ->assertRedirect('/home');

        $this->assertEquals(1, User::count());
    }
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

    /** @test */
    function registration_requires_a_country()
    {
        $this->post(route('register'), make(User::class, ['country' => null])->toArray())
            ->assertSessionHasErrors('country');

        $this->assertEquals(0, User::count());
    }
}
