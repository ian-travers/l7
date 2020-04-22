<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;

class AccountController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile()
    {
        return view('frontend.settings.profile', ['user' => auth()->user()]);
    }

    public function account()
    {
        return view('frontend.settings.account', ['user' => auth()->user()]);
    }

    public function team()
    {
        return view('frontend.settings.team', ['user' => auth()->user()]);
    }
}
