<?php

namespace App\Http\Controllers\User;

use App\Entities\Blog\Post\Post;
use App\Entities\User;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

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

        $user->posts()->create($this->validateRequest());

        return redirect()->route('user.posts')->with('flash', json_encode([
            'type' => 'success',
            'title' => __('flash.success'),
            'message' => __('flash.post-saved'),
        ]));
    }

    /**
     * @return array
     * @throws ValidationException
     */
    private function validateRequest()
    {
        $formData =  $this->validate(request(), [
            'title' => 'required|string|max:255',
            'excerpt' => 'required',
            'body' => 'required',
            'image' => 'nullable',
        ]);

        return $formData + ['slug' => $formData['title']];
    }
}
