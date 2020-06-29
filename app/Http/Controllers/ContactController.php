<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use Mail;

class ContactController extends Controller
{
    public function create()
    {
        return view('frontend.contact.show');
    }

    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store()
    {
        Mail::to('test@test.lan')->send(new ContactMail($this->validate(request(), [
            'name' => 'required|string|max:255',
            'email' => 'required|email:filter',
            'subject' => 'required|string|max:255',
            'body' => 'required',
        ])));

        if (Mail::failures()) {
            return back()->with('flash', json_encode([
                'type' => 'error',
                'title' => __('flash.error'),
                'message' => __('contact.mail-send-failure'),
            ]));
        }

        return back()->with('flash', json_encode([
            'type' => 'success',
            'title' => __('flash.success'),
            'message' => __('contact.mail-was-sent'),
        ]));
    }
}
