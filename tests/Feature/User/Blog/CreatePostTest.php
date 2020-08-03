<?php

namespace Tests\Feature\User;

use App\Entities\Blog\Post\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class CreatePostTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function user_can_create_a_post()
    {
        $this->signIn();

        /** @var Post $post */
        $post = make(Post::class);

        $this->post('/user/posts', $post->toArray())
            ->assertStatus(Response::HTTP_FOUND);

        $this->assertDatabaseHas('posts', $post->toArray());
    }

    /** @test */
    function slug_will_be_unique_if_titles_of_posts_are_the_same()
    {
        $this->signIn();

        /** @var Post $post */
        $post = make(Post::class, ['title' => 'The same title']);

        $this->post('/user/posts', $post->toArray())
            ->assertStatus(Response::HTTP_FOUND);
        $this->assertDatabaseHas('posts', $post->toArray());

        /** @var Post $anotherPost */
        $anotherPost = make(Post::class, ['title' => 'The same title']);

        $this->post('/user/posts', $anotherPost->toArray())
            ->assertStatus(Response::HTTP_FOUND);

        $anotherPost = Post::find(2);

        $this->assertDatabaseHas('posts', $anotherPost->getAttributes());
        $this->assertNotEquals($post->slug, $anotherPost->slug);
    }
}
