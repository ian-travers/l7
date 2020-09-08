<?php

namespace App\Http\Controllers;

use App\Entities\Blog\Post\Post;
use App\Entities\Comment;

class BlogsController extends Controller
{
    use Commenting;

    public function index()
    {
        $posts = Post::with('author')->published()->paginate(6);

        return view('frontend.blogs.index', compact('posts'));
    }

    public function show(string $slug)
    {
        /** @var Post $post */
        $post = Post::where('slug', $slug)->published()->firstOrFail();
        $commentViews = Comment::treeRecursive($post->comments, null);

        $post->increment('views_count');

        return view('frontend.blogs.show', compact('post', 'commentViews'));
    }

    public function comment(string $slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();

        if (!$this->publishComment($post)) {
            return redirect()->back()->with('flash', json_encode([
                'type' => 'success',
                'title' => __('flash.success'),
                'message' => __('flash.wrong-parent'),
            ]));
        };

        return redirect()->back()->with('flash', json_encode([
            'type' => 'success',
            'title' => __('flash.success'),
            'message' => __('flash.comment-added'),
        ]));
    }
}
