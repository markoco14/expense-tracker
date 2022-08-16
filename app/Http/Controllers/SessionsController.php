<?php

namespace App\Http\Controllers;

use App\Models\User;

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
            $user = User::where('email', $attributes['email'])->first();
            $user->createToken('app-auth')->plainTextToken;
            $response = [
                'success' => 'Welcome back!',
            ];
            return redirect('tracking')->with(['response' => $response]);
        }

        return back()
            ->withInput()
            ->withErrors([
                'email' => 'Your provided credentials could not be verified.'
            ]);
    }

    public function destroy() {
        User::find(auth()->user()->id)->tokens()->delete();
        auth()->logout();
        return redirect('login');
    }
}
