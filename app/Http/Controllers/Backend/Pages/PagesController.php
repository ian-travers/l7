<?php

namespace App\Http\Controllers\Backend\Pages;

use App\Entities\Page\Page;
use App\Http\Controllers\Controller;

class PagesController extends Controller
{
    public function index()
    {
        $pages = Page::paginate(20);

        return view('backend.pages.index', compact('pages'));
    }

    public function create()
    {
        $page = new Page();
        $rootPages = $this->getRootPages();

        return view('backend.pages.create', compact('page', 'rootPages'));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store()
    {
        Page::create($this->validateRequest());

        return redirect()->route('admin.pages')->with('flash', json_encode([
            'type' => 'success',
            'title' => __('flash.success'),
            'message' => __('flash.page-saved'),
        ]));
    }

    public function edit(Page $page)
    {
        $rootPages = $this->getRootPages();

        return view('backend.pages.edit', compact('page', 'rootPages'));
    }

    /**
     * @param \App\Entities\Page\Page $page
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Page $page)
    {
        $page->update($this->validateRequest());

        return redirect()->route('admin.pages')->with('flash', json_encode([
            'type' => 'success',
            'title' => __('flash.success'),
            'message' => __('flash.page-updated'),
        ]));
    }

    public function show(Page $page)
    {
        return view('backend.pages.show', compact('page'));
    }

    /**
     * @param \App\Entities\Page\Page $page
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Exception
     */
    public function remove(Page $page)
    {
        $page->delete();

        return redirect()->route('admin.pages')->with('flash', json_encode([
            'type' => 'success',
            'title' => __('flash.success'),
            'message' => __('flash.page-deleted'),
        ]));
    }

    /**
     * @return array
     * @throws \Illuminate\Validation\ValidationException
     */
    private function validateRequest()
    {
        return $this->validate(request(), [
            'path' => 'required|string|max:255',
            'link_en' => 'required|string|max:50',
            'link_ru' => 'required|string|max:50',
            'title_en' => 'required|string|max:255',
            'title_ru' => 'required|string|max:255',
            'content_en' => 'required',
            'content_ru' => 'required',
        ]);
    }

    private function getRootPages()
    {
        return Page::roots()->get();
    }
}
