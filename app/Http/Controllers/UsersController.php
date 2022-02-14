<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;

// use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
// use Illuminate\Foundation\Bus\DispatchesJobs;
// use Illuminate\Foundation\Validation\ValidatesRequests;
// use Illuminate\Routing\Controller as BaseController;

class UsersController extends Controller
{
    public function create() {
        return view('signup');
    }

    public function store() {
        // echo "You have signed up";
        $attributes = request()->validate([
            'name' => ['required','max:255'],
            'username' => ['required','max:255','min:3'],
            'email' => ['required','email','max:255'],
            'password' => ['required','min:7'],
        ]);

        User::create($attributes);
        return redirect('login');
    }
    
    public function login() {
        return view('login');
    }
}
