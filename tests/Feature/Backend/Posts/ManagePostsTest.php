<?php

namespace Tests\Feature\Backend\Posts;

use App\Entities\Blog\Post\Post;
use App\Entities\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class ManagePostsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function guests_cannot_manage_posts()
    {
        $this->get('/adm/pages')
            ->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect('/login');
    }

    /** @test */
    function unauthorized_user_cannot_manage_posts()
    {
        $this->signIn();

        $this->get('/adm/posts')
            ->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect('/')
            ->assertSessionHas('flash', json_encode([
                'type' => 'warning',
                'title' => __('flash.warning'),
                'message' => __('flash.not-enough-rights'),
            ]));
    }

    /** @test */
    function unauthorized_user_cannot_edit_the_post()
    {
        $this->signIn();

        /** @var Post $page */
        $post = create(Post::class);

        $this->get("/adm/posts/{$post->id}/edit", $post->toArray())
            ->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect('/')
            ->assertSessionHas('flash', json_encode([
                'type' => 'warning',
                'title' => __('flash.warning'),
                'message' => __('flash.not-enough-rights'),
            ]));
    }

    /** @test */
    function admin_can_restore_a_post()
    {
        /** @var Post $post */
        $post = create(Post::class);
        $post->delete();

        $this->assertTrue($post->trashed());

        /** @var User $admin */
        $admin = factory(User::class)->states('admin')->create();
        $this->signIn($admin);

        $this->patch(route('admin.posts.restore', $post))
            ->assertSessionHas('flash', json_encode([
                'type' => 'success',
                'title' => __('flash.success'),
                'message' => __('flash.post-restored'),
            ]));

        $this->assertFalse($post->fresh()->trashed());
    }

    /** @test */
    function admin_can_delete_a_post()
    {
        /** @var Post $post */
        $post = create(Post::class);

        /** @var User $admin */
        $admin = factory(User::class)->states('admin')->create();
        $this->signIn($admin);

        $postAsArray = $post->getAttributes();

        $this->assertDatabaseHas('posts', $postAsArray);

        $this->delete(route('admin.posts.delete', $post))
            ->assertSessionHas('flash', json_encode([
                'type' => 'success',
                'title' => __('flash.success'),
                'message' => __('flash.post-deleted'),
            ]));

        $this->assertDatabaseMissing('posts', $postAsArray);
    }
}
