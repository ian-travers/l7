<?php

namespace App\Http\Controllers;

use App\Entities\Comment;
use App\Entities\News\News;

class NewsController extends Controller
{
    use Commenting;

    public function index()
    {
        $news = News::latest()->paginate(6);

        return view('frontend.news.index', compact('news'));
    }

    public function show(string $slug)
    {
        /** @var News $news */
        $news = News::where('slug', $slug)->firstOrFail();
        $commentViews = Comment::treeRecursive($news->comments, null);

        return view('frontend.news.show', compact('news', 'commentViews'));
    }

    public function comment(string $slug)
    {
        $news = News::where('slug', $slug)->firstOrFail();

        $this->publishComment($news);
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
