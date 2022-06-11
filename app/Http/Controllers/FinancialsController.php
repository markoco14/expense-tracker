<?php

namespace App\Http\Controllers;

use App\Models\UserBudget;
use App\Models\UserSalary;
use App\Models\UserDeduction;
use App\Models\UserSaving;
use App\Services\DeductionCalculatorService;
use Carbon\Carbon;

class FinancialsController extends Controller
{
    public function index(DeductionCalculatorService $deductionCalculatorService) {
        $monthlySalary = $deductionCalculatorService->getSalary();
        $allDeductions = $deductionCalculatorService->getDeductions();
        $totalDeductions = 0;
        foreach ($allDeductions as $deduction) {
            $totalDeductions += $deduction['deduction_amount'];
        }
        $savings = $deductionCalculatorService->getSavings();
        $dailyBudget = $deductionCalculatorService->getDailyBudget();
        $monthlyBudget = $dailyBudget * Carbon::now()->daysInMonth;
        
        return view('profile', [
            'monthlySalary' => number_format($monthlySalary),
            'totalDeductions' => number_format($totalDeductions),
            'savings' => number_format($savings),
            'dailyBudget' => number_format($dailyBudget),
            'monthlyBudget' => number_format($monthlyBudget),
            'allDeductions' => $allDeductions
        ]);
    }

    // salaries function
    public function salaries() {
        // dd('You hit the salaries endpoint');
        UserSalary::where('salary_status', 'CURRENT')
        ->where('user_id', auth()->user()->id)
        ->update(['salary_status' => 'OOD']);
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
        // dd(request()->input());
        UserDeduction::where('deduction_status', 'CURRENT')
        ->where('user_id', auth()->user()->id)
        ->update(['deduction_status' => 'OOD']);
        $rules = [];
        foreach(request()->input() as $key => $value) {
            if ($key === '_token' || $key === 'submit') {
                continue;
            } else {
                $rules[$key] = 'required';
            }
        }
        $attributes = request()->validate($rules);

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
        UserSaving::where('savings_status', 'CURRENT')
        ->where('user_id', auth()->user()->id)
        ->update(['savings_status' => 'OOD']);
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
        UserBudget::where('budget_status', 'CURRENT')
        ->where('user_id', auth()->user()->id)
        ->update(['budget_status' => 'OOD']);
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
