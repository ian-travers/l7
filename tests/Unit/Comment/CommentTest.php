<?php

namespace Tests\Unit\Comment;

use App\Entities\Comment;
use App\Entities\News\News;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function create_a_comment_test()
    {
        $this->signIn();

        /** @var News $commentable */
        $commentable = create(News::class);

        $comment = Comment::createComment($commentable, 'comment body', auth()->user());

        $this->assertDatabaseHas('comments', $comment->getAttributes());
    }

    /** @test */
    function update_a_comment_test()
    {
        $this->signIn();

        /** @var News $commentable */
        $commentable = create(News::class);

        $comment = Comment::createComment($commentable, 'comment body', auth()->user());

        Comment::updateComment($comment->id, ['body' => 'updated']);

        $this->assertEquals('updated', $comment->fresh()->body);
    }

    /** @test */
    function delete_a_comment_test()
    {
        $this->signIn();

        /** @var News $commentable */
        $commentable = create(News::class);

        $comment = Comment::createComment($commentable, 'comment body', auth()->user());

        $this->assertDatabaseHas('comments', $comment->getAttributes());

        Comment::deleteComment($comment->id);

        $this->assertDatabaseMissing('comments', $comment->getAttributes());

    }
}
