<?php

namespace Tests\Feature\Backend\Posts;

use App\Entities\Blog\Post\Post;
use App\Entities\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ValidatePostsTest extends TestCase
{
    use RefreshDatabase;

    protected function prepareTest(): Post
    {
        /** @var User $admin */
        $admin = factory(User::class)->states('admin')->create();
        $this->signIn($admin);

        return create(Post::class);
    }

    /** @test */
    function post_requires_title_excerpt_body()
    {
        $post = $this->prepareTest();

        $this->patch(route('admin.posts.update', $post), ['title' => null])
            ->assertSessionHasErrors('excerpt');
        $this->patch(route('admin.posts.update', $post), ['excerpt' => null])
            ->assertSessionHasErrors('body');
        $this->patch(route('admin.posts.update', $post), ['body' => null])
            ->assertSessionHasErrors('title');
    }
}
