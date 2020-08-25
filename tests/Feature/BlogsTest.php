<?php

namespace Tests\Feature;

use App\Entities\Blog\Post\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlogsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function views_count_increments_each_time_the_post_is_read()
    {
        $this->withoutExceptionHandling();
        /** @var Post $post */
        $post = create(Post::class);
        $post->publish();

        $this->assertEquals(0, $post->views_count);

        $this->get('/blogs/' . $post->slug);

        $this->assertEquals(1, $post->fresh()->views_count);
    }
}
