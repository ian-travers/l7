<?php

namespace App\Http\Controllers\User;

use App\Entities\Blog\Post\Post;
use App\Entities\User;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;
use Str;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        /** @var User $user */
        $user = auth()->user();

        $posts = $user->posts()->latest()->paginate(6);

        return view('frontend.user.posts.index', compact('posts'));
    }

    public function create()
    {
        return view('frontend.user.posts.create', ['post' => new Post()]);
    }

    /**
     * @return string
     * @throws ValidationException
     */
    public function store()
    {
        /** @var User $user */
        $user = auth()->user();

        $formData = $this->validateRequest();

        $user->posts()->create([
            'title' => $formData['title'],
            'slug' => Str::slug($formData['title']),
            'excerpt' => $formData['excerpt'],
            'body' => $formData['body'],
            'image' => isset($formData['image']) ? $formData['image']->store('blogs', 'public') : null,
        ]);

        return redirect()->route('user.posts')->with('flash', json_encode([
            'type' => 'success',
            'title' => __('flash.success'),
            'message' => __('flash.post-saved'),
        ]));
    }

    /**
     * @param Post $post
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Post $post)
    {
        $this->authorize('update', $post);

        return view('frontend.user.posts.edit', ['post' => $post]);
    }

    /**
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     * @throws ValidationException
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Post $post)
    {
        $this->authorize('update', $post);

        $formData = $this->validateRequest();

        $imageFilename = isset($formData['image']) ? $formData['image']->store('blogs', 'public') : null;

        if ($imageFilename) {
            $post->withoutImage();
            $post->update([
                'image' => $imageFilename,
            ]);

        }

        $post->update([
            'title' => $formData['title'],
            'slug' => Str::slug($formData['title']),
            'excerpt' => $formData['excerpt'],
            'body' => $formData['body'],
        ]);

        return redirect()->route('user.posts')->with('flash', json_encode([
            'type' => 'success',
            'title' => __('flash.success'),
            'message' => __('flash.post-updated'),
        ]));
    }

    public function removeImage(Post $post)
    {
        $post->withoutImage();
    }

    /**
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function remove(Post $post)
    {
        $this->authorize('update', $post);

        $post->delete();

        return redirect()->route('user.posts')->with('flash', json_encode([
            'type' => 'success',
            'title' => __('flash.success'),
            'message' => __('flash.post-deleted'),
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
