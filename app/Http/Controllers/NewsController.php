<?php

namespace App\Http\Controllers;

use App\Entities\Comment;
use App\Entities\News\News;

class NewsController extends Controller
{
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
        /** @var News $news */
        $news = News::where('slug', $slug)->firstOrFail();

        // TODO: validate request

        $body = request('body');

        $parent = request('parent_id') ? Comment::findOrFail(request('parent_id')) : null;

        $news->comment($body, auth()->user(), $parent);

        return redirect()->back()->with('flash', json_encode([
            'type' => 'success',
            'title' => __('flash.success'),
            'message' => __('flash.comment-added'),
        ]));
    }
}
