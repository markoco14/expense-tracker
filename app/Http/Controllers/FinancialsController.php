<?php

namespace App\Http\Controllers;

use App\Models\UserBudget;
use App\Models\UserSalary;
use App\Models\UserDeduction;
use App\Models\UserSaving;

use Illuminate\Http\Client\Request;
use Carbon\Carbon;

// use Illuminate\Support\Facades\DB;

// use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
// use Illuminate\Foundation\Bus\DispatchesJobs;
// use Illuminate\Foundation\Validation\ValidatesRequests;
// use Illuminate\Routing\Controller as BaseController;

class FinancialsController extends Controller
{
    public function index() {
        return view('profile');
    }

    // salaries function
    public function salaries() {
        // dd('You hit the salaries endpoint');
        $attributes = request()->validate([
            'salary' => ['required']
        ]);

        // dd($attributes);
        $salary = new UserSalary;
        $salary->user_id = auth()->user()->id;
        $salary->salary_amount = $attributes['salary'];
        $salary->salary_status = 'CURRENT';
        $salary->job_category = 'NULL';
        $salary->job_title = 'NULL';
        $salary->month = Carbon::now()->month;
        // dd($salary);
        $salary->save();
        return redirect('profile');

    }
    // deductions function
    public function deductions() {
        // dd('You hit the deductions endpoint');
        $attributes = request()->validate([
            'li' => ['required'],
            'nhi' => ['required'],
            'rent' => ['required'],
            'utilities' => ['required']
        ]);

        // dd($attributes);

        foreach ($attributes as $key => $value) {
            $deduction = new UserDeduction;
            $deduction->user_id = auth()->user()->id;
            $deduction->deduction_name = $key;
            $deduction->deduction_amount = $value;
            $deduction->deduction_status = 'CURRENT';
            $deduction->deduction_type = 'deduction';
            $deduction->month = Carbon::now()->month;
            // dd($deduction);
            $deduction->save();
            // TODO: change the type later (employment, necessities, etc)
        }
        return redirect('profile');


    }
    // savings function
    public function savings() {
        // dd('You hit the savings endpoint');
        $attributes = request()->validate([
            'savings' => ['required']
        ]);

        // dd($attributes);

        $saving = new UserSaving;
        $saving->user_id = auth()->user()->id;
        $saving->savings_name = 'monthly';
        $saving->savings_status = 'CURRENT';
        $saving->savings_amount = $attributes['savings'];
        // dd($saving);
        // $saving->month = Carbon::now()->month;
        // dd($saving);
        $saving->save();

        return redirect('profile');

    }

    // budgets function
    public function budgets() {
        // dd('You hit the budgets endpoint');
        $attributes = request()->validate([
            'budgets' => ['required']
        ]);

        // dd($attributes);
        $budget = new UserBudget;
        $budget->user_id = auth()->user()->id;
        $budget->budget_name = 'daily';
        $budget->budget_status = 'CURRENT';
        $budget->budget_amount = $attributes['budgets'];
        // $budget->month = Carbon::now()->month;
        // dd($budget);
        $budget->save();

        return redirect('profile');
    }
}
