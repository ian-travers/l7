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

        request()->validate([
            'nickname' => 'required|string|min:3|max:15|regex:/^[a-zA-Z0-9]{3,15}$/s|unique:users,nickname,' . $user->id,
            'name' => 'nullable|string|max:40',
            'country' => 'required|string:2'
        ]);

        $user->update([
            'nickname' => request('nickname'),
            'name' => request('name'),
            'country' => request('country'),
        ]);

        return redirect()->route('settings.profile');
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
