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

        /** @var News $news */
        $news = create(News::class);

        $this->post(route('news.comment', $news->slug), $comment)
            ->assertRedirect(route('login'));

        /** @var Post $post */
        $post = factory(Post::class)->states('published')->create();

        $this->post(route('blogs.comment', $post->slug))
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
        /** @var News $news */
        $news = create(News::class);

        $this->signIn();

        $comment = [
            'body' => 'This is a news comment',
            'parent_id' => null,
        ];

        $this->post(route('news.comment', $news->slug), $comment);

        $comment = Comment::find(1);

        $this->signIn(create(User::class));

        $this->patch("/comments/{$comment->id}", [
            'body' => 'Comment was updated',
        ])->assertStatus(Response::HTTP_FORBIDDEN);
    }
}
