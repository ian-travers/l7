<?php

namespace App\Http\Controllers\Backend\Posts;

use App\Entities\Blog\Post\Post;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Str;

class PostsController extends Controller
{
    public function index()
    {
        $posts = Post::withTrashed()->latest()->with('author')->paginate(6);

        return view('backend.posts.index', compact('posts'));
    }

    public function edit(string $id)
    {
        $post = Post::withTrashed()->find($id);

        return view('backend.posts.edit', ['post' => $post]);
    }

    /**
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws ValidationException
     */
    public function update(string $id)
    {
        $formData = $this->validateRequest();

        $post = Post::withTrashed()->findOrFail($id);
        $post->update([
            'title' => $formData['title'],
            'slug' => Str::slug($formData['title']),
            'excerpt' => $formData['excerpt'],
            'body' => $formData['body'],
        ]);

        return redirect()->back()->with('flash', json_encode([
            'type' => 'success',
            'title' => __('flash.success'),
            'message' => __('flash.post-updated'),
        ]));
    }

    /**
     * @param string $id
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(string $id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->forceDelete();

        return redirect()->back()->with('flash', json_encode([
            'type' => 'success',
            'title' => __('flash.success'),
            'message' => __('flash.post-deleted'),
        ]));
    }

    public function restore(string $id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->restore();

        return redirect()->back()->with('flash', json_encode([
            'type' => 'success',
            'title' => __('flash.success'),
            'message' => __('flash.post-restored'),
        ]));
    }

    /**
     * @return array
     * @throws ValidationException
     */
    private function validateRequest()
    {
        $formData = $this->validate(request(), [
            'title' => 'required|string|max:255',
            'excerpt' => 'required',
            'body' => 'required',
            'image' => 'nullable|image',
        ]);

        return $formData + ['slug' => $formData['title']];
    }
}
