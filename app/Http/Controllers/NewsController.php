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

        return view('frontend.news.show', compact('news'));
    }

    public function comment(string $slug)
    {
        /** @var News $news */
        $news = News::where('slug', $slug)->firstOrFail();

        $body = request('body');

        $parent = Comment::findOrFail(request('parent_id'));

        $news->comment($body, auth()->user(), $parent);

        return redirect()->back()->with('flash', json_encode([
            'type' => 'success',
            'title' => __('flash.success'),
            'message' => __('flash.comment-added'),
        ]));
    }
}
