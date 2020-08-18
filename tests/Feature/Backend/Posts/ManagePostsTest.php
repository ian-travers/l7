<?php

namespace Tests\Feature\Backend\Posts;

use App\Entities\Blog\Post\Post;
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

        $this->get('/adm/pages')
            ->assertStatus(Response::HTTP_FOUND)
            ->assertRedirect('/')
            ->assertSessionHas('flash', json_encode([
                'type' => 'warning',
                'title' => __('flash.warning'),
                'message' => __('flash.not-enough-rights'),
            ]));
    }

    /** @test */
    function unauthorized_user_cannot_edit_the_page()
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
}
