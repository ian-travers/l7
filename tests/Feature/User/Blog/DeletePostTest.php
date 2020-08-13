<?php

namespace Tests\Feature\User;

use App\Entities\Blog\Post\Post;
use App\Entities\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class DeletePostTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function author_can_delete_own_post()
    {
        $this->signIn();

        /** @var Post $post */
        $post = create(Post::class);

        $cachedPost = $post->getAttributes();

        $this->assertDatabaseHas('posts', $cachedPost);

        $this->delete(route('user.posts.delete', $post));

        $this->assertDatabaseMissing('posts', $cachedPost);
    }

    /** @test */
    function user_can_not_delete_another_post()
    {
        $this->signIn();

        /** @var User $user */
        $user = create(User::class);

        /** @var Post $post */
        $post = create(Post::class, ['author_id' => $user->id]);

        $cachedPost = $post->getAttributes();

        $this->delete(route('user.posts.delete', $post))
            ->assertStatus(Response::HTTP_FORBIDDEN);


        $this->assertDatabaseHas('posts', $cachedPost);
    }
}
