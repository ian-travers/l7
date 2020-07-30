<?php

namespace App\Http\Controllers\User;

use App\Entities\Blog\Post\Post;
use App\Entities\User;
use App\Http\Controllers\Controller;
use Illuminate\Validation\ValidationException;

class PostsController extends Controller
{
    /**
     * @var User
     */
    private $user;

    public function __construct()
    {
        $this->middleware('auth');
        $this->user = auth()->user();
    }

    public function index()
    {
        $posts = Post::paginate(20);

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
        $this->user->posts()->create($this->validateRequest());

        return 'post store';
    }

    /**
     * @return array
     * @throws ValidationException
     */
    private function validateRequest()
    {
        return $this->validate(request(), [
            'title' => 'required|string|max:255',
            'excerpt' => 'required',
            'body' => 'required',
            'image' => 'nullable',
            'published_at' => 'nullable',
            'deleted_at' => 'nullable',
            'slug' => 'nullable',
            'view_count' => 'nullable',
        ]);
    }
}
