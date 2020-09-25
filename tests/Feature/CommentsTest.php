<?php

namespace Tests\Feature;

use App\Entities\Blog\Post\Post;
use App\Entities\Comment;
use App\Entities\News\News;
use App\Entities\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class CommentsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function guest_can_not_comment_news_and_post()
    {
        $comment = [
            'body' => 'This is a comment',
            'parent_id' => null,
        ];

        $slug = 'slug';

        $this->post(route('news.comment', $slug), $comment)
            ->assertRedirect(route('login'));
        $this->post(route('blogs.comment', $slug), $comment)
            ->assertRedirect(route('login'));
    }

    /** @test */
    function authenticated_user_can_comment_a_news()
    {
        /** @var News $news */
        $news = create(News::class);

        $this->signIn();

        $comment = [
            'body' => 'This is a news comment',
            'parent_id' => null,
        ];

        $this->post(route('news.comment', $news->slug), $comment)
            ->assertStatus(Response::HTTP_FOUND);

        $this->assertDatabaseHas('comments', $comment);
        $this->get(route('news.show', $news->slug))
            ->assertSee('This is a news comment');
    }

    /** @test */
    function authenticated_user_can_comment_a_post()
    {
        /** @var Post $post */
        $post = factory(Post::class)->states('published')->create();

        $this->signIn();

        $comment = [
            'body' => 'This is a post comment',
            'parent_id' => null,
        ];

        $this->post(route('blogs.comment', $post->slug), $comment)
            ->assertStatus(Response::HTTP_FOUND);

        $this->assertDatabaseHas('comments', $comment);

        $this->get(route('blogs.show', $post->slug))
            ->assertSee('This is a post comment');
    }

    /** @test */
    function author_can_edit_own_news_comment()
    {
        /** @var News $news */
        $news = create(News::class);

        $this->signIn();

        $comment = [
            'body' => 'This is a news comment',
            'parent_id' => null,
        ];

        $this->post(route('news.comment', $news->slug), $comment);

        $this->get(route('news.show', $news->slug))
            ->assertSee('This is a news comment');

        $comment = Comment::find(1);

        $this->patch("/comments/{$comment->id}", [
            'body' => 'Comment was updated',
        ]);

        $this->get(route('news.show', $news->slug))
            ->assertSee('Comment was updated')
            ->assertDontSee('This is a news comment');
    }

    /** @test */
    function author_can_edit_own_post_comment()
    {
        /** @var Post $post */
        $post = factory(Post::class)->states('published')->create();

        $this->signIn();

        $comment = [
            'body' => 'This is a post comment',
            'parent_id' => null,
        ];

        $this->post(route('blogs.comment', $post->slug), $comment);

        $this->get(route('blogs.show', $post->slug))
            ->assertSee('This is a post comment');

        $comment = Comment::find(1);

        $this->patch("/comments/{$comment->id}", [
            'body' => 'Comment was updated',
        ]);

        $this->get(route('blogs.show', $post->slug))
            ->assertSee('Comment was updated')
            ->assertDontSee('This is a post comment');
    }

    /** @test */
    function user_can_not_update_other_people_comment()
    {
        /** @var Comment $comment */
        $comment = create(Comment::class);

        $this->signIn(create(User::class));

        $this->patch("/comments/{$comment->id}", [
            'body' => 'Comment was updated',
        ])->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /** @test */
    function unauthorized_users_can_not_delete_comments()
    {
        /** @var Comment $comment */
        $comment = create(Comment::class);

        $this->delete("/comments/{$comment->id}")
            ->assertRedirect(route('login'));

        $this->signIn()
            ->delete("/comments/{$comment->id}")
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /** @test */
    function authorized_users_can_delete_comments()
    {
        /** @var Comment $comment */
        $comment = create(Comment::class);

        $cacheComment = $comment->getAttributes();

        $this->assertDatabaseHas('comments', $cacheComment);

        $user = User::find($comment->user_id);

        $this->signIn($user)
            ->delete("/comments/{$comment->id}")
            ->assertStatus(Response::HTTP_FOUND);

        $this->assertDatabaseMissing('comments', $cacheComment);
    }

    /** @test */
    function comment_with_child_can_not_be_deleted()
    {
        /** @var Comment $comment */
        $comment = create(Comment::class);

        /** Create a child comment */
        create(Comment::class, ['parent_id' => $comment->id]);

        $user = User::find($comment->user_id);

        $this->signIn($user)
            ->delete("/comments/{$comment->id}")
            ->assertSessionHas('flash', json_encode([
                'type' => 'warning',
                'title' => __('flash.warning'),
                'message' => __('flash.comment-edit-only'),
            ]));
    }
}
