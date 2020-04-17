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
        return view('settings.profile', ['user' => auth()->user()]);
    }

    public function account()
    {
        return view('settings.account', ['user' => auth()->user()]);
    }

    public function team()
    {
        return view('settings.team', ['user' => auth()->user()]);
    }
}
