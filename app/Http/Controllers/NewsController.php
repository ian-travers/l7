<?php

namespace App\Http\Controllers;

use App\Entities\Comment;
use App\Entities\News\News;

class NewsController extends Controller
{
    use Commenting, LikingDisliking;

    public function index()
    {
        $allNews = News::latest()
            ->withCount('comments')
            ->withCount('likes')
            ->withCount('dislikes')
            ->paginate(4);

        return view('frontend.news.index', compact('allNews'));
    }

    public function show(string $slug)
    {
        /** @var News $news */
        $news = News::where('slug', $slug)
            ->with('comments')
            ->withCount('comments')
            ->withCount('likes')
            ->withCount('dislikes')
            ->firstOrFail();

        $commentViews = Comment::treeRecursive($news->comments, null);

        return view('frontend.news.show', compact('news', 'commentViews'));
    }

    /**
     * @param string $slug
     *
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function comment(string $slug)
    {
        $news = News::where('slug', $slug)->firstOrFail();

        if (!$this->publishComment($news)) {
            return redirect()->back()->with('flash', json_encode([
                'type' => 'success',
                'title' => __('flash.success'),
                'message' => __('flash.wrong-parent'),
            ]));
        }

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

    public function like(News $news)
    {
        return $this->storeLike($news);
    }

    public function unlike(News $news)
    {
        return $this->removeLike($news);
    }

    public function dislike(News $news)
    {
        return $this->storeDislike($news);
    }

    public function undislike(News $news)
    {
        return $this->removeDislike($news);
    }
}
