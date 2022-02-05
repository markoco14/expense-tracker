<?php

namespace App\Http\Controllers;
use App\Models\User;

// use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
// use Illuminate\Foundation\Bus\DispatchesJobs;
// use Illuminate\Foundation\Validation\ValidatesRequests;
// use Illuminate\Routing\Controller as BaseController;

class UsersController extends Controller
{
    public function index() {
        return view('signup');
    }

    public function register() {
        // echo "You have signed up";
        $user = User::create([
            'name' => $_POST['name'],
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            'password' => $_POST['password']

        ]);
        return view('login', [
            'name' => $name,
            'username' => $username,
            'email' => $email,
            'password' => $password
        ]);
    }
}
