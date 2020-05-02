<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\User;

class AccountController extends Controller
{
    public function profile()
    {
        return view('frontend.settings.profile', ['user' => auth()->user()]);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateProfile()
    {
        /** @var User $user */
        $user = auth()->user();

        $this->validate(request(), [
            'nickname' => 'required|string|min:3|max:15|regex:/^[a-zA-Z0-9]{3,15}$/s|unique:users,nickname,' . $user->id,
            'name' => 'nullable|string|max:40',
            'country' => 'required|string:2'
        ]);

        $user->update([
            'nickname' => request('nickname'),
            'name' => request('name'),
            'country' => request('country'),
        ]);

        return back()->with('flash', json_encode([
            'title' => __('Done'),
            'message' => __('Profile has been updated.'),
        ]));
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updateAvatar()
    {
        $this->validate(request(), [
            'avatar' => 'required|image',
        ]);

        /** @var User $user */
        $user = auth()->user();

        $user->update([
            'avatar_path' => request()->file('avatar')->store('avatars', 'public'),
        ]);

        return back()->with('flash', json_encode([
            'title' => __('Success'),
            'message' => __('Avatar has been updated.'),
        ]));
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
