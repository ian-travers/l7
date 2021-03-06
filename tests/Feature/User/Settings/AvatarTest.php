<?php

namespace Tests\Feature\User\Settings;

use App\Entities\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Storage;
use Tests\TestCase;

class AvatarTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function only_registered_user_can_add_avatar()
    {
        $this->json('post', 'settings/profile/avatar')
            ->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    /** @test */
    function valid_avatar_must_be_provided()
    {
        $this->signIn();

        $this->json('post', 'settings/profile/avatar', [
            'avatar' => 'not-an-image',
        ])
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /** @test */
    function user_may_add_avatar_to_their_profile()
    {
        $this->signIn();

        Storage::fake('public');

        $this->json('post', 'settings/profile/avatar', [
            'avatar' => $file = UploadedFile::fake()->image('avatar.jpg'),
        ]);

        $this->assertEquals('avatars/' . $file->hashName(), auth()->user()->avatar_path);
        Storage::disk('public')->assertExists('avatars/' . $file->hashName());
    }

    /** @test */
    function user_may_remove_avatar_from_their_profile()
    {
        $this->signIn();

        Storage::fake('public');

        $this->json('post', 'settings/profile/avatar', [
            'avatar' => $file = UploadedFile::fake()->image('avatar.jpg'),
        ]);

        $this->assertNotNull(auth()->user()->avatar_path);
        $this->assertEquals('avatars/' . $file->hashName(), auth()->user()->avatar_path);

        $this->json('post', 'settings/profile/no-avatar');
        $this->assertNull(auth()->user()->avatar_path);
    }

    /** @test */
    function avatar_file_is_deleted_when_user_change_or_remove_avatar()
    {
        $this->signIn();

        Storage::fake('public');

        $this->json('post', 'settings/profile/avatar', [
            'avatar' => $file = UploadedFile::fake()->image('avatar.jpg'),
        ]);

        Storage::disk('public')->assertExists('avatars/' . $file->hashName());

        // Changing avatar
        $this->json('post', 'settings/profile/avatar', [
            'avatar' => $newFile = UploadedFile::fake()->image('new-avatar.jpg'),
        ]);
        Storage::disk('public')->assertMissing('avatars/' . $file->hashName());
        Storage::disk('public')->assertExists('avatars/' . $newFile->hashName());

        // Removing avatar
        $this->json('post', 'settings/profile/no-avatar');
        Storage::disk('public')->assertMissing('avatars/' . $newFile->hashName());
    }

    /** @test */
    function avatar_file_is_deleted_when_user_change_custom_avatar_to_pre_made()
    {
        /** @var User $user */
        $user = create(User::class);
        $this->signIn($user);

        Storage::fake('public');

        $this->json('post', 'settings/profile/avatar', [
            'avatar' => $file = UploadedFile::fake()->image('avatar.jpg'),
        ]);

        Storage::disk('public')->assertExists('avatars/' . $file->hashName());

        $this->json('post', 'settings/profile', [
            'nickname' => $user->nickname,
            'country' => $user->country,
            'avatar' => '1',
        ]);

        Storage::disk('public')->assertMissing('avatars/' . $file->hashName());
    }
}
