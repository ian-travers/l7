<?php

namespace Tests\Feature;

use App\Entities\Blog\Post\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function guest_can_not_like_any_post()
    {
        $this->post('/blogs/1/like')
            ->assertRedirect('/login');
    }

    /** @test */
    function authenticated_user_can_like_any_post()
    {
        $this->withoutExceptionHandling();
        /** @var Post $news */
        $post = create(Post::class);

        $this->signIn();

        $this->post('/blogs/' . $post->id . '/like');

        $this->assertCount(1, $post->likes);
    }

    /** @test */
    function authenticated_user_may_only_like_any_post_once()
    {
        $this->withoutExceptionHandling();
        /** @var Post $post */
        $post = create(Post::class);

        $this->signIn();

        $this->post('/blogs/' . $post->id . '/like');
        $this->post('/blogs/' . $post->id . '/like');

        $this->assertCount(1, $post->likes);
    }

    /** @test */
    function authenticated_user_can_unlike_previously_liked_post()
    {
        $this->withoutExceptionHandling();
        /** @var Post $post */
        $post = create(Post::class);

        $this->signIn();

        $post->like();

        $this->post('/blogs/' . $post->id . '/unlike');

        $this->assertCount(0, $post->likes);
    }

    /** @test */
    function authenticated_user_may_only_unlike_previously_liked_post_once()
    {
        /** @var Post $post */
        $post = create(Post::class);

        $this->signIn();

        $post->like();

        $this->post('/blogs/' . $post->id . '/unlike');
        $this->post('/blogs/' . $post->id . '/unlike');

        $this->assertCount(0, $post->likes);
    }

    /** @test */
    function authenticated_user_may_toggle_dislike_to_like_in_one_touch()
    {
        /** @var Post $post */
        $post = create(Post::class);

        $this->signIn();

        $post->dislike();

        $this->assertCount(0, $post->likes);
        $this->assertCount(1, $post->dislikes);

        $this->post("/blogs/{$post->id}/like");

        $post = $post->fresh();

        $this->assertCount(1, $post->likes);
        $this->assertCount(0, $post->dislikes);
    }

    /** @test */
    function authenticated_user_can_dislike_any_post()
    {
        $this->withoutExceptionHandling();
        /** @var Post $post */
        $post = create(Post::class);

        $this->signIn();

        $this->post('/blogs/' . $post->id . '/dislike');

        $this->assertCount(1, $post->dislikes);
    }

    /** @test */
    function authenticated_user_may_only_dislike_any_post_once()
    {
        $this->withoutExceptionHandling();
        /** @var Post $post */
        $post = create(Post::class);

        $this->signIn();

        $this->post('/blogs/' . $post->id . '/dislike');
        $this->post('/blogs/' . $post->id . '/dislike');

        $this->assertCount(1, $post->dislikes);
    }

    /** @test */
    function authenticated_user_can_undislike_previously_disliked_post()
    {
        $this->withoutExceptionHandling();
        /** @var Post $post */
        $post = create(Post::class);

        $this->signIn();

        $post->dislike();

        $this->post('/blogs/' . $post->id . '/undislike');

        $this->assertCount(0, $post->dislikes);
    }

    /** @test */
    function authenticated_user_may_only_undislike_previously_disliked_post_once()
    {
        /** @var Post $post */
        $post = create(Post::class);

        $this->signIn();

        $post->dislike();

        $this->post('/blogs/' . $post->id . '/undislike');
        $this->post('/blogs/' . $post->id . '/undislike');

        $this->assertCount(0, $post->dislikes);
    }

    /** @test */
    function authenticated_user_may_toggle_like_to_dislike_in_one_touch()
    {
        /** @var Post $post */
        $post = create(Post::class);

        $this->signIn();

        $post->like();

        $this->assertCount(1, $post->likes);
        $this->assertCount(0, $post->dislikes);

        $this->post("/blogs/{$post->id}/dislike");

        $post = $post->fresh();

        $this->assertCount(0, $post->likes);
        $this->assertCount(1, $post->dislikes);
    }
}
