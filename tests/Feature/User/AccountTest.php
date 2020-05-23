<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AccountTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function user_must_login_before_edit_owns_settings()
    {
        $this->get(route('settings.profile'))
            ->assertRedirect(route('login'));
        $this->get(route('settings.account'))
            ->assertRedirect(route('login'));
        $this->get(route('settings.team'))
            ->assertRedirect(route('login'));
    }
}
