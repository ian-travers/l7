<?php

namespace Tests\Unit\Blog;

use App\Entities\Blog\Post\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Storage;
use Tests\TestCase;

class PostTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    function check_has_image_function()
    {
        $post = make(Post::class, ['image' => null]);

        $this->assertFalse($post->hasImage());

        $post = make(Post::class, ['image' => 'blogs/image.png']);

        $this->assertTrue($post->hasImage());
    }

    /** @test */
    function check_without_image_works_properly()
    {
        Storage::fake('public');

        $image = UploadedFile::fake()->image('blog-intro.jpg');
        $image->store('blogs', 'public');

        $post = create(Post::class, [
            'image' => "blogs/{$image->hashName()}",
        ]);

        $this->assertTrue($post->hasImage());
        Storage::disk('public')->assertExists('blogs/' . $image->hashName());

        $post->withoutImage();
        $this->assertFalse($post->hasImage());
        Storage::disk('public')->assertMissing('blogs/' . $image->hashName());
    }
}
