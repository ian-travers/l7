<?php

namespace Tests\Feature\User\Settings;

use App\Entities\User;
use Hash;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class AccountTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function user_can_update_email()
    {
        /** @var User $user */
        $user = create(User::class, ['email' => 'test@mail.com']);

        $this->signIn($user);

        $this->post('/settings/account/email', ['email' => 'new@mail.com'])
            ->assertStatus(Response::HTTP_FOUND)
            ->assertSessionHas('flash', json_encode([
                'type' => 'success',
                'title' => __('flash.success'),
                'message' => __('auth.email-updated'),
            ]));

        $this->assertEquals('new@mail.com', $user->email);
    }

    /** @test */
    function user_must_provide_a_valid_email_address_for_updating()
    {
        /** @var User $user */
        $user = create(User::class);

        $this->signIn($user);

        $this->post('/settings/account/email', ['email' => ''])
            ->assertSessionHasErrors('email');

        $this->post('/settings/account/email', ['email' => 'wrong-email'])
            ->assertSessionHasErrors('email');

        $this->post('/settings/account/email', ['email' => '@'])
            ->assertSessionHasErrors('email');

        $this->post('/settings/account/email', ['email' => 'one@two'])
            ->assertSessionHasErrors('email');
    }

    /** @test */
    function user_must_provide_unique_email()
    {
        /** @var User $user */
        $user = create(User::class);

        // Create another user with specific email
        create(User::class, ['email' => 'john@mail.com']);

        $this->signIn($user);

        $this->post('/settings/account/email', ['email' => 'john@mail.com'])
            ->assertSessionHasErrors('email');
    }

    /** @test */
    function user_may_change_password()
    {
        /** @var User $user */
        $user = create(User::class);

        $this->signIn($user);

        $this->json('post', '/settings/account/password', [
            'password' => 'newpassword',
            'password_confirmation' => 'newpassword',
        ])
            ->assertStatus(Response::HTTP_FOUND)
            ->assertSessionHas('flash', json_encode([
                'type' => 'success',
                'title' => __('flash.success'),
                'message' => __('auth.password-changed'),
            ]));

    }

    /** @test */
    function user_can_delete_own_account()
    {
        $this->withoutExceptionHandling();
        /** @var User $user */
        $user = create(User::class, ['password' => Hash::make('11111111')]);

        $this->signIn($user);

        $this->post('/settings/account', [
            'passwordCheck' => '11111111',
            'verifyPhrase' => 'delete my account',
        ])
            ->assertRedirect('/');
    }
}
