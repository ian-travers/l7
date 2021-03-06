<?php

namespace Tests\Feature;

use App\Entities\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DislikesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function guest_can_not_like_anything()
    {
        $this->post('/comments/1/dislike')
            ->assertRedirect('/login');
        $this->post('/news/1/dislike')
            ->assertRedirect('/login');
        $this->post('/blogs/1/dislike')
            ->assertRedirect('/login');
    }

    /** @test */
    function authenticated_user_can_dislike_any_comment()
    {
        /** @var Comment $comment */
        $comment = create(Comment::class);

        $this->signIn();

        $this->post('/comments/' . $comment->id . '/dislike');

        $this->assertCount(1, $comment->dislikes);
    }

    /** @test */
    function authenticated_user_may_only_dislike_any_comment_once()
    {
        /** @var Comment $comment */
        $comment = create(Comment::class);

        $this->signIn();

        $this->post('/comments/' . $comment->id . '/dislike');
        $this->post('/comments/' . $comment->id . '/dislike');

        $this->assertCount(1, $comment->dislikes);
    }

    /** @test */
    function authenticated_user_can_undislike_previously_disliked_comment()
    {
        /** @var Comment $comment */
        $comment = create(Comment::class);

        $this->signIn();

        $comment->dislikes();

        $this->post('/comments/' . $comment->id . '/undislike');

        $this->assertCount(0, $comment->dislikes);
    }

    /** @test */
    function authenticated_user_may_only_undislike_previously_disliked_comment_once()
    {
        /** @var Comment $comment */
        $comment = create(Comment::class);

        $this->signIn();

        $this->post('/comments/' . $comment->id . '/dislike');

        $this->assertCount(1, $comment->dislikes);

        $this->post('/comments/' . $comment->id . '/undislike');
        $this->post('/comments/' . $comment->id . '/undislike');

        $this->assertCount(0, $comment->fresh()->dislikes);
    }

    /** @test */
    function authenticated_user_may_toggle_like_to_dislike_in_one_touch()
    {
        /** @var Comment $comment */
        $comment = create(Comment::class);

        $this->signIn();

        $this->post('/comments/' . $comment->id . '/like');

        $this->assertCount(0, $comment->dislikes);
        $this->assertCount(1, $comment->likes);

        $this->post('/comments/' . $comment->id . '/dislike');

        $comment = $comment->fresh();
        $this->assertCount(1, $comment->dislikes);
        $this->assertCount(0, $comment->likes);
    }
}
