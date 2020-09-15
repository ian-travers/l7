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
        $this->withoutExceptionHandling();
        /** @var Comment $comment */
        $comment = create(Comment::class);

        $this->signIn();

        $this->post('/comments/' . $comment->id . '/like');
        $this->post('/comments/' . $comment->id . '/like');

        $this->assertCount(1, $comment->likes);
    }
}
