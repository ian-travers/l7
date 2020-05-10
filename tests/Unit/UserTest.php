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
    function user_get_proper_pre_made_avatar_index()
    {
        /** @var User $user */
        $user = make(User::class, ['avatar_path' => 'avatars/pre/1.png']);

        $this->assertEquals('1', $user->getPreMadeAvatarIndex());
    }

    /** @test */
    function user_can_not_remove_pre_made_avatar_image_file()
    {
        /** @var User $user */
        $user = make(User::class, ['avatar_path' => 'avatars/pre/1.png']);

        $this->assertFalse($user->removeAvatarFile());
    }
}
