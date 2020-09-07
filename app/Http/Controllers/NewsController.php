<?php

namespace App\Http\Controllers;

use App\Entities\Comment;
use App\Entities\News\News;
use Illuminate\Validation\ValidationException;

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

        // TODO: extract a trait or something
        try {
            $formData = $this->validateRequest();
        } catch (ValidationException $e) {
            throw new \DomainException($e->getMessage());
        }

        if ($formData['parent_id'] == $news->id) {
            return redirect()->back()->with('flash', json_encode([
                'type' => 'warning',
                'title' => __('flash.warning'),
                'message' => __('flash.wrong-parent'),
            ]));
        }

        $news->comment($formData['body'], auth()->user(), $formData['parent_id']);

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
}
