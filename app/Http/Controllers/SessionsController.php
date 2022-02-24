<?php

namespace App\Http\Controllers;

class SessionsController extends Controller
{
    public function login() {
        return view('login');
    }

    public function store() {
        // validate the request
        $attributes = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        // attmept to authentice and log in the user
        // based on the provided credentials
        if (auth()->attempt($attributes)) {
            return redirect('record')->with('success', 'Welcome back!');
        }
        // redirect with a success flash messaage

        return back()->withErrors([
            'email' => 'Your provided email could not be verified.'
        ]);
    }

    public function destroy() {
        // log that mother fucker out
        // dd("You just logged out! No! Don't go! Baby, please. Stay with me.");
        return view('welcome');
    }
}
