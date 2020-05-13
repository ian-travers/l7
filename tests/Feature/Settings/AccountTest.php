<?php

namespace Tests\Feature\Settings;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
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

        $this->post('/settings/account/email', ['email' => 'new@mail.com']);

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
}
