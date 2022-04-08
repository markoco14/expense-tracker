<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserDeduction;
use App\Models\UserSalary;


class BudgetController extends Controller
{
    public function index() {

        $monthlySalary = UserSalary::where('user_id', auth()->user()->id)
            ->pluck('salary_amount')
            ->toArray()[0];
        // dd($monthlySalary);
        $labourInsurance = UserDeduction::where('user_id', auth()->user()->id)
            ->where('deduction_name', 'li')
            ->pluck('deduction_amount')
            ->toArray()[0];
        $nationalHealthInsurance = UserDeduction::where('user_id', auth()->user()->id)
            ->where('deduction_name', 'nhi')
            ->pluck('deduction_amount')
            ->toArray()[0];
        $deductions = $labourInsurance + $nationalHealthInsurance;
        $takeHomePay = $monthlySalary - $deductions;
        $rent = UserDeduction::where('user_id', auth()->user()->id)
            ->where('deduction_name', 'rent')
            ->pluck('deduction_amount')
            ->toArray()[0];
        $utilities = UserDeduction::where('user_id', auth()->user()->id)
            ->where('deduction_name', 'utilities')
            ->pluck('deduction_amount')
            ->toArray()[0];
        $savings = UserDeduction::where('user_id', auth()->user()->id)
            ->where('deduction_name', 'savings')
            ->pluck('deduction_amount')
            ->toArray()[0];
        $beforeDailyExpenses = $takeHomePay - $rent - $utilities - $savings;
        $totalDailyBudget = 34 * 500;
        $surplus = $beforeDailyExpenses - $totalDailyBudget;

        return view('budget.details', [
            'monthlySalary' => number_format($monthlySalary),
            'deductions' => number_format($deductions),
            'labourInsurance' => number_format($labourInsurance),
            'nationalHealthInsurance' => number_format($nationalHealthInsurance),
            'takeHomePay' => number_format($takeHomePay),
            'rent' => number_format($rent),
            'utilities' => number_format($utilities),
            'savings' => number_format($savings),
            'beforeDailyExpenses' => number_format($beforeDailyExpenses),
            'totalDailyBudget' => number_format($totalDailyBudget),
            'surplus' => number_format($surplus)
        ]);
    }

    public function setup() {
        return view('budget.setup');
    }
}
