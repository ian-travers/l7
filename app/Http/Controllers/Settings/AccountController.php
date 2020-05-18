<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\User;
use Hash;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

class AccountController extends Controller
{
    public function profile()
    {
        return view('frontend.settings.profile', ['user' => auth()->user()]);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     * @throws ValidationException
     */
    public function updateProfile()
    {
        /** @var User $user */
        $user = auth()->user();

        $this->validate(request(), [
            'nickname' => 'required|string|min:3|max:15|regex:/^[a-zA-Z0-9]{3,15}$/s|unique:users,nickname,' . $user->id,
            'name' => 'nullable|string|max:40',
            'country' => 'required|string:2',
            'avatar' => 'nullable|string|max:1|regex:/^[1-8]{1}$/s',
        ]);

        $user->update([
            'nickname' => request('nickname'),
            'name' => request('name'),
            'country' => request('country'),
        ]);

        if (request()->has('avatar')) {
            $user->removeAvatarFile();
            $user->update([
                'avatar_path' => 'avatars/pre/' . request('avatar') . '.png',
            ]);
        }

        return back()->with('flash', json_encode([
            'title' => __('flash.success'),
            'message' => __('flash.profile-updated'),
        ]));
    }

    /**
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Http\RedirectResponse|Response
     * @throws ValidationException
     */
    public function updateAvatar()
    {
        $this->validate(request(), [
            'avatar' => 'required|image|file|max:2048',
        ]);

        /** @var User $user */
        $user = auth()->user();

        $user->removeAvatarFile();
        $user->update([
            'avatar_path' => request()->file('avatar')->store('avatars', 'public'),
        ]);

        if (request()->wantsJson()) {
            return response([], Response::HTTP_OK);
        }

        return back()->with('flash', json_encode([
            'title' => __('flash.success'),
            'message' => __('flash.avatar-is-updated'),
        ]));
    }

    public function removeAvatar()
    {
        /** @var User $user */
        $user = auth()->user();

        $user->withoutAvatar();

        if (request()->wantsJson()) {
            return response([], Response::HTTP_OK);
        }

        return back()->with('flash', json_encode([
            'title' => __('flash.success'),
            'message' => __('flash.avatar-is-removed'),
        ]));
    }

    public function account()
    {
        return view('frontend.settings.account', ['user' => auth()->user()]);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     * @throws ValidationException
     */
    public function updateEmail()
    {
        /** @var User $user */
        $user = auth()->user();

        $this->validate(request(), [
            'email' => 'required|string|email:filter|max:255|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'email' => request('email'),
        ]);

        return back()->with('flash', json_encode([
            'title' => __('flash.success'),
            'message' => __('auth.email-updated'),
        ]));
    }

    /**
     * @throws ValidationException
     */
    public function changePassword()
    {
        /** @var User $user */
        $user = auth()->user();

        $this->validate(request(), [
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user->update([
            'password' => Hash::make(request('password')),
        ]);

        return back()->with('flash', json_encode([
            'title' => __('flash.success'),
            'message' => __('auth.password-changed'),
        ]));
    }

    /**
     * @throws ValidationException
     * @throws \Exception
     */
    public function deleteAccount()
    {
        /** @var User $user */
        $user = auth()->user();

        $this->validate(request(), [
            'passwordCheck' => 'required|password',
            'verifyPhrase' => 'required|regex:/^delete my account$/s'
        ]);

        auth()->logout();
//        $user->delete();

        return redirect('/');
    }

    public function team()
    {
        return view('frontend.settings.team', ['user' => auth()->user()]);
    }
}
