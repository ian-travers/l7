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

        $this->post('/settings/profile', ['nickname' => 'NEED4FUN', 'name' => 'Jane Doe']);

        $this->assertEquals('NEED4FUN', $user->nickname);
        $this->assertEquals('Jane Doe', $user->name);
    }
}
