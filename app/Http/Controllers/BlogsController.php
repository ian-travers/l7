<?php

namespace App\Http\Controllers;

use App\Entities\Blog\Post\Post;
use App\Entities\Comment;
use Illuminate\Validation\ValidationException;

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
        $commentViews = Comment::treeRecursive($post->comments, null);

        $post->increment('views_count');

        return view('frontend.blogs.show', compact('post', 'commentViews'));
    }

    public function comment(string $slug)
    {
        /** @var Post $post */
        $post = Post::where('slug', $slug)->firstOrFail();

        // TODO: extract a trait or something
        try {
            $formData = $this->validateRequest();
        } catch (ValidationException $e) {
            throw new \DomainException($e->getMessage());
        }

        if ($formData['parent_id'] == $post->id) {
            return redirect()->back()->with('flash', json_encode([
                'type' => 'warning',
                'title' => __('flash.warning'),
                'message' => __('flash.wrong-parent'),
            ]));
        }

        $post->comment($formData['body'], auth()->user(), $formData['parent_id']);

        return redirect()->back()->with('flash', json_encode([
            'type' => 'success',
            'title' => __('flash.success'),
            'message' => __('flash.comment-added'),
        ]));
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateRequest()
    {
        return $this->validate(request(), [
            'body' => 'required',
            'parent_id' => 'nullable|exists:comments,id',
        ]);
    }
}
