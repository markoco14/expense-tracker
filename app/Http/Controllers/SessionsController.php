<?php

namespace App\Http\Controllers;

class SessionsController extends Controller
{
    public function create() {
        return view('login');
    }

    public function store() {
        $attributes = request()->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if (auth()->attempt($attributes)) {
            return redirect('tracking')->with('success', 'Welcome back!');
        }

        return back()
            ->withInput()
            ->withErrors([
                'email' => 'Your provided credentials could not be verified.'
            ]);
    }

    public function destroy() {
        auth()->logout();
        return view('index');
    }
}
