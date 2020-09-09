<?php

namespace Tests\Feature;

use App\Entities\Blog\Post\Post;
use App\Entities\News\News;
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

    // TODO: edit && delete tests
}
