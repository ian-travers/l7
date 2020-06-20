<?php

namespace App\Http\Controllers;

use App\Entities\Page\Page;

class StaticPagesController extends Controller
{
    public function __invoke(string $path)
    {
        $page = Page::where('path', "/{$path}")->first();

        return view('frontend.pages.' . $path, compact('page'));
    }
}
