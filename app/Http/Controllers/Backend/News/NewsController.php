<?php

namespace App\Http\Controllers\Backend\News;

use App\Entities\News\News;
use App\Http\Controllers\Controller;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::withTrashed()->latest()->paginate(10);

        return view('backend.news.index', compact('news'));
    }

    public function create()
    {
        return view('backend.news.create', ['news' => new News()]);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store()
    {
        News::create($this->validateRequest());

        return redirect()->route('admin.news')->with('flash', json_encode([
            'type' => 'success',
            'title' => __('flash.success'),
            'message' => __('flash.news-saved'),
        ]));
    }

    public function edit(News $news)
    {
        return view('backend.news.edit', compact('news'));
    }

    /**
     * @param News $news
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(News $news)
    {
        $news->update($this->validateRequest());

        return redirect()->route('admin.news', ['page' => request()->query('page')])->with('flash', json_encode([
            'type' => 'success',
            'title' => __('flash.success'),
            'message' => __('flash.news-updated'),
        ]));
    }

    /**
     * @param News $news
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(News $news)
    {
        $news->delete();

        return redirect()->back()->with('flash', json_encode([
            'type' => 'success',
            'title' => __('flash.success'),
            'message' => __('flash.news-deleted'),
        ]));
    }

    public function restore(string $id)
    {
        $news = News::withTrashed()->findOrFail($id);
        $news->restore();

        return redirect()->back()->with('flash', json_encode([
            'type' => 'success',
            'title' => __('flash.success'),
            'message' => __('flash.news-restored'),
        ]));
    }

    public function forceRemove(string $id)
    {
        $news = News::withTrashed()->findOrFail($id);
        $news->forceDelete();

        return redirect()->back()->with('flash', json_encode([
            'type' => 'success',
            'title' => __('flash.success'),
            'message' => __('flash.news-force-deleted'),
        ]));
    }

    /**
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    private function validateRequest()
    {
        $formData = $this->validate(request(), [
            'title_en' => 'required|string|max:255',
            'title_ru' => 'required|string|max:255',
            'body_en' => 'required',
            'body_ru' => 'required',
        ]);

        return array_merge($formData, [
            'author_id' => auth()->id(),
            'slug' => $formData['title_en'],
        ]);
    }
}
