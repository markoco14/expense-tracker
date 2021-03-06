<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\UserBudget;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades;
use Illuminate\Validation\Rule;
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
        
        $attributes = request()->validate([
            'name' => ['required','max:255'],
            'username' => ['required','min:3','max:255',Rule::unique('users', 'username')],
            'email' => ['required','email','max:255',Rule::unique('users', 'email')],
            'password' => ['required','min:7'],
        ]);

        User::create($attributes);

        $user = User::where('email', $attributes['email'])
        ->get()
        ->toArray();

        $budget = new UserBudget;
        $budget->user_id = $user[0]['id'];
        $budget->budget_name = 'Daily';
        $budget->budget_status = 'CURRENT';
        $budget->budget_amount = 0;
        $budget->save();
        // $budget->month = Carbon::now()->month;


        session()->flash('success', 'Your account has been created.');

        return redirect('login');
    }
    
    public function credentials() {
        return view('login');
    }

}
