<?php

namespace Tests\Feature;

use App\Entities\News\News;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NewsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function guest_can_not_like_any_news()
    {
        $this->post('/news/1/like')
            ->assertRedirect('/login');
    }

    /** @test */
    function authenticated_user_can_like_any_news()
    {
        $this->withoutExceptionHandling();
        /** @var News $news */
        $news = create(News::class);

        $this->signIn();

        $this->post('/news/' . $news->id . '/like');

        $this->assertCount(1, $news->likes);
    }

    /** @test */
    function authenticated_user_may_only_like_any_news_once()
    {
        $this->withoutExceptionHandling();
        /** @var News $news */
        $news = create(News::class);

        $this->signIn();

        $this->post('/news/' . $news->id . '/like');
        $this->post('/news/' . $news->id . '/like');

        $this->assertCount(1, $news->likes);
    }

    /** @test */
    function authenticated_user_can_unlike_previously_liked_news()
    {
        $this->withoutExceptionHandling();
        /** @var News $news */
        $news = create(News::class);

        $this->signIn();

        $news->like();

        $this->post('/news/' . $news->id . '/unlike');

        $this->assertCount(0, $news->likes);
    }

    /** @test */
    function authenticated_user_may_only_unlike_previously_liked_news_once()
    {
        /** @var News $news */
        $news = create(News::class);

        $this->signIn();

        $news->like();

        $this->post('/news/' . $news->id . '/unlike');
        $this->post('/news/' . $news->id . '/unlike');

        $this->assertCount(0, $news->likes);
    }

    /** @test */
    function authenticated_user_may_toggle_dislike_to_like_in_one_touch()
    {
        /** @var News $news */
        $news = create(News::class);

        $this->signIn();

        $news->dislike();

        $this->assertCount(0, $news->likes);
        $this->assertCount(1, $news->dislikes);

        $this->post("/news/{$news->id}/like");

        $news = $news->fresh();

        $this->assertCount(1, $news->likes);
        $this->assertCount(0, $news->dislikes);
    }

    /** @test */
    function authenticated_user_can_dislike_any_news()
    {
        $this->withoutExceptionHandling();
        /** @var News $news */
        $news = create(News::class);

        $this->signIn();

        $this->post('/news/' . $news->id . '/dislike');

        $this->assertCount(1, $news->dislikes);
    }

    /** @test */
    function authenticated_user_may_only_dislike_any_news_once()
    {
        $this->withoutExceptionHandling();
        /** @var News $news */
        $news = create(News::class);

        $this->signIn();

        $this->post('/news/' . $news->id . '/dislike');
        $this->post('/news/' . $news->id . '/dislike');

        $this->assertCount(1, $news->dislikes);
    }

    /** @test */
    function authenticated_user_can_undislike_previously_disliked_news()
    {
        $this->withoutExceptionHandling();
        /** @var News $news */
        $news = create(News::class);

        $this->signIn();

        $news->dislike();

        $this->post('/news/' . $news->id . '/undislike');

        $this->assertCount(0, $news->dislikes);
    }

    /** @test */
    function authenticated_user_may_only_undislike_previously_disliked_news_once()
    {
        /** @var News $news */
        $news = create(News::class);

        $this->signIn();

        $news->dislike();

        $this->post('/news/' . $news->id . '/undislike');
        $this->post('/news/' . $news->id . '/undislike');

        $this->assertCount(0, $news->dislikes);
    }

    /** @test */
    function authenticated_user_may_toggle_like_to_dislike_in_one_touch()
    {
        /** @var News $news */
        $news = create(News::class);

        $this->signIn();

        $news->like();

        $this->assertCount(1, $news->likes);
        $this->assertCount(0, $news->dislikes);

        $this->post("/news/{$news->id}/dislike");

        $news = $news->fresh();

        $this->assertCount(0, $news->likes);
        $this->assertCount(1, $news->dislikes);
    }
}
