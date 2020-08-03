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

        dd('index');

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

//        dd($formData);

        $user->posts()->create([
            'title' => $formData['title'],
            'slug' => Str::slug($formData['title']),
            'excerpt' => $formData['excerpt'],
            'body' => $formData['body'],
            'image' => $formData['image'] ? $formData['image']->store('blogs', 'public') : null,
        ]);

//        dd('12300');

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
        $formData = $this->validate(request(), [
            'title' => 'required|string|max:255',
            'excerpt' => 'required',
            'body' => 'required',
            'image' => 'nullable|image',
        ]);

        return $formData + ['slug' => $formData['title']];
    }
}
