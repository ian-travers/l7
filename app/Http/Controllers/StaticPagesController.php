<?php

namespace App\Http\Controllers;

class StaticPagesController extends Controller
{
    public function __invoke(string $page)
    {
        return view('frontend.pages.' . $page);
    }
}
