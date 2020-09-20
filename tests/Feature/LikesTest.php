<?php

namespace Tests\Feature;

use App\Entities\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LikesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function guest_can_not_like_anything()
    {
        $this->post('/comments/1/like')
            ->assertRedirect('/login');
    }

    /** @test */
    function authenticated_user_can_like_any_comment()
    {
        /** @var Comment $comment */
        $comment = create(Comment::class);

        $this->signIn();

        $this->post('/comments/' . $comment->id . '/like');

        $this->assertCount(1, $comment->likes);
    }

    /** @test */
    function authenticated_user_may_only_like_any_comment_once()
    {
        /** @var Comment $comment */
        $comment = create(Comment::class);

        $this->signIn();

        $this->post('/comments/' . $comment->id . '/like');
        $this->post('/comments/' . $comment->id . '/like');

        $this->assertCount(1, $comment->likes);
    }

    /** @test */
    function authenticated_user_can_unlike_previously_liked_comment()
    {
        /** @var Comment $comment */
        $comment = create(Comment::class);

        $this->signIn();

        $comment->like();

        $this->post('/comments/' . $comment->id . '/unlike');

        $this->assertCount(0, $comment->likes);
    }

    /** @test */
    function authenticated_user_may_only_unlike_previously_liked_comment_once()
    {
        /** @var Comment $comment */
        $comment = create(Comment::class);

        $this->signIn();

        $this->post('/comments/' . $comment->id . '/like');

        $this->assertCount(1, $comment->likes);

        $this->post('/comments/' . $comment->id . '/unlike');
        $this->post('/comments/' . $comment->id . '/unlike');

        $this->assertCount(0, $comment->fresh()->likes);
    }

    /** @test */
    function authenticated_user_may_toggle_dislike_to_like_in_one_touch()
    {
        /** @var Comment $comment */
        $comment = create(Comment::class);

        $this->signIn();

        $this->post('/comments/' . $comment->id . '/dislike');

        $this->assertCount(0, $comment->likes);
        $this->assertCount(1, $comment->dislikes);

        $this->post('/comments/' . $comment->id . '/like');

        $comment = $comment->fresh();
        $this->assertCount(1, $comment->likes);
        $this->assertCount(0, $comment->dislikes);
    }
}
