<?php

namespace App\Http\Controllers;

use App\Entities\Blog\Post\Post;

class BlogsController extends Controller
{
    public function index()
    {
        $posts = Post::with('author')->published()->paginate(6);

        return view('frontend.blogs.index', compact('posts'));
    }

    public function show(string $slug)
    {
        /** @var Post $post */
        $post = Post::where('slug', $slug)->published()->firstOrFail();

        $post->increment('views_count');

        return view('frontend.blogs.show', compact('post'));
    }
}
