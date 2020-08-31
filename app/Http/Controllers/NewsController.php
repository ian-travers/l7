<?php

namespace App\Http\Controllers;

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
        /** @var News $post */
        $news = News::where('slug', $slug)->firstOrFail();

        return view('frontend.news.show', compact('news'));
    }
}
