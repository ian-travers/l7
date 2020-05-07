<?php

namespace Tests\Unit;

use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function user_may_not_use_an_avatar()
    {
        /** @var User $user */
        $user = create(User::class, ['avatar_path' => 'avatars/default.webp']);

        $this->assertNotNull($user->avatar_path);

        $user->withoutAvatar();

        $this->assertNull($user->avatar_path);
    }

    /** @test */
    function check_has_avatar()
    {
        /** @var User $user */
        $user = create(User::class, ['avatar_path' => 'avatars/default.webp']);

        $this->assertTrue($user->hasAvatar());

        $user->withoutAvatar();

        $this->assertFalse($user->hasAvatar());
    }
}
