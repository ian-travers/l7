<?php

namespace App\Http\Controllers;

use App\Entities\Blog\Post\Post;
use App\Entities\Comment;

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

    public function comment(string $slug)
    {
        /** @var Post $post */
        $post = Post::where('slug', $slug)->firstOrFail();

        // TODO: validate request

        $body = request('body');

        $parent = request('parent_id') ? Comment::findOrFail(request('parent_id')) : null;

        $post->comment($body, auth()->user(), $parent);

        return redirect()->back()->with('flash', json_encode([
            'type' => 'success',
            'title' => __('flash.success'),
            'message' => __('flash.comment-added'),
        ]));
    }
}
