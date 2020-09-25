<?php

namespace Tests\Feature\Backend\News;

use App\Entities\News\News;
use App\Entities\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class ManageNewsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function guests_cannot_manage_news()
    {
        $this->get('/adm/news')
            ->assertRedirect('/login');
    }

    /** @test */
    function unauthorized_user_cannot_manage_news()
    {
        $this->signIn();

        $this->get('/adm/news')
            ->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect('/')
            ->assertSessionHas('flash', json_encode([
                'type' => 'warning',
                'title' => __('flash.warning'),
                'message' => __('flash.not-enough-rights'),
            ]));
    }

    /** @test */
    function admin_can_create_a_news()
    {
        /** @var User $admin */
        $admin = factory(User::class)->states('admin')->create();
        $this->signIn($admin);

        /** @var News $news */
        $news = make(News::class, ['author_id' => $admin->id]);


        $this->post('/adm/news', $news->toArray());

        $this->assertDatabaseHas('news', $news->getAttributes());
    }

    /** @test */
    function admin_can_edit_the_news()
    {
        $this->withoutExceptionHandling();
        /** @var User $admin */
        $admin = factory(User::class)->states('admin')->create();
        $this->signIn($admin);

        /** @var News $news */
        $news = create(News::class, ['author_id' => $admin->id]);

        $this->patch("/adm/news/{$news->id}", array_merge($news->toArray(), [
            'title_en' => 'Title UPD',
            'body_en' => 'New news body updated',
        ]));

        $news = $news->fresh();

        $this->assertEquals('Title UPD', $news->title_en);
        $this->assertEquals('New news body updated', $news->body_en);
    }

    /** @test */
    function admin_can_delete_and_restore_the_news()
    {
        /** @var User $admin */
        $admin = factory(User::class)->states('admin')->create();
        $this->signIn($admin);

        /** @var News $news */
        $news = create(News::class, ['author_id' => $admin->id]);

        $this->assertFalse($news->trashed());

        $this->delete(route('admin.news.delete', $news))
            ->assertSessionHas('flash', json_encode([
                'type' => 'success',
                'title' => __('flash.success'),
                'message' => __('flash.news-deleted'),
            ]));

        $this->assertTrue($news->fresh()->trashed());

        $this->patch(route('admin.news.restore', $news->id))
            ->assertSessionHas('flash', json_encode([
                'type' => 'success',
                'title' => __('flash.success'),
                'message' => __('flash.news-restored'),
            ]));

        $this->assertFalse($news->fresh()->trashed());
    }

    /** @test */
    function admin_can_force_delete_the_news()
    {
        /** @var User $admin */
        $admin = factory(User::class)->states('admin')->create();
        $this->signIn($admin);

        /** @var News $news */
        $news = create(News::class, ['author_id' => $admin->id]);

        $this->assertDatabaseHas('news', $news->getAttributes());

        $this->delete(route('admin.news.delete', $news))
            ->assertSessionHas('flash', json_encode([
                'type' => 'success',
                'title' => __('flash.success'),
                'message' => __('flash.news-deleted'),
            ]));

        $this->assertTrue($news->fresh()->trashed());

        $newsCache = $news->getAttributes();
        $this->assertDatabaseHas('news', $newsCache);

        $this->delete(route('admin.news.force-delete', $news));

        $this->assertDatabaseMissing('news', $newsCache);
    }
}
