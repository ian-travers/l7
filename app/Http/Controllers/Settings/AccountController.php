<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\User;

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

    public function updateProfile()
    {
        /** @var User $user */
        $user = auth()->user();

        $user->update([
            'nickname' => request('nickname'),
            'name' => request('name')
        ]);
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
