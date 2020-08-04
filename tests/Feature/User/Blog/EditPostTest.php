<?php

namespace Tests\Feature\User;

use App\Entities\Blog\Post\Post;
use Arr;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Response;
use Tests\TestCase;

class EditPostTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function guest_can_not_see_edit_post_page()
    {
        $this->get(route('user.posts.edit', ['post' => create(Post::class)]))
            ->assertRedirect(route('login'));
    }

    /** @test */
    function unauthorized_users_may_not_update_posts()
    {
        $post = $this->preparePost();

        $this->signIn();

        $this->patch(route('user.posts.update', $post), [
            'title' => 'New title',
            'body' => 'New body'
        ])->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /** @test */
    function author_can_edit_own_post()
    {
        $this->signIn();

        /** @var Post $post */
        $post = make(Post::class, ['author_id' => auth()->id()]);

        $this->post('/user/posts', $post->toArray())
            ->assertStatus(Response::HTTP_FOUND);

        $this->assertDatabaseHas('posts', $post->toArray());

        $post = Post::find(1);

        $formData = [
            'title' => 'New Title',
            'excerpt' => 'New Excerpt',
            'body' => 'New Content',
            'image' => null,
        ];

        $this->patch(route('user.posts.update', compact('post')), $formData)
            ->assertStatus(Response::HTTP_FOUND);

        $post = $post->fresh();
        $this->assertEquals('New Title', $post->title);
        $this->assertEquals('New Excerpt', $post->excerpt);
        $this->assertEquals('New Content', $post->body);

        $this->assertDatabaseHas('posts', $post->getAttributes());
    }

    /** @test */
    function post_requires_a_title()
    {
        $post = $this->preparePost();

        $data = $post->getAttributes();
        Arr::set($data, 'title', null);

        $this->patch(route('user.posts.update', $post), $data)
            ->assertSessionHasErrors('title');
    }

    /** @test */
    function post_requires_an_excerpt()
    {
        $post = $this->preparePost();

        $data = $post->getAttributes();
        Arr::set($data, 'excerpt', null);

        $this->patch(route('user.posts.update', $post), $data)
            ->assertSessionHasErrors('excerpt');
    }

    /** @test */
    function post_requires_a_body()
    {
        $post = $this->preparePost();

        $data = $post->getAttributes();
        Arr::set($data, 'body', null);

        $this->patch(route('user.posts.update', $post), $data)
            ->assertSessionHasErrors('body');
    }

    protected function preparePost()
    {
        $this->signIn();

        return create(Post::class);
    }
}
