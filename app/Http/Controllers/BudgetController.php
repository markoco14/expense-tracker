<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\UserDeduction;
use App\Models\UserSalary;
use Illuminate\Http\Request;


class BudgetController extends Controller
{
    public function index() {

        $monthlySalary = UserSalary::where('user_id', auth()->user()->id)
            ->pluck('salary_amount');
        if ($monthlySalary->isNotEmpty()) {
            $monthlySalary = $monthlySalary->toArray()[0];
        } else {
            $monthlySalary = 0;
        }
            
        $labourInsurance = UserDeduction::where('user_id', auth()->user()->id)
            ->where('deduction_name', 'li')
            ->pluck('deduction_amount');
        if ($labourInsurance->isNotEmpty()){
            $labourInsurance = $labourInsurance->toArray()[0];
        } else {
            $labourInsurance = 0;
        }

        $nationalHealthInsurance = UserDeduction::where('user_id', auth()->user()->id)
            ->where('deduction_name', 'nhi')
            ->pluck('deduction_amount');
        if ($nationalHealthInsurance->isNotEmpty()) {
            $nationalHealthInsurance = $nationalHealthInsurance->toArray()[0];
        } else {
            $nationalHealthInsurance = 0;
        }

        if (gettype($labourInsurance) !== 'integer' && gettype($nationalHealthInsurance) !== 'integer') {
            $deductions = 0;
            $takeHomePay = 0;
        } else {
            $deductions = $labourInsurance + $nationalHealthInsurance;
            $takeHomePay = $monthlySalary - $deductions;
        }

        $rent = UserDeduction::where('user_id', auth()->user()->id)
            ->where('deduction_name', 'rent')
            ->pluck('deduction_amount');

        $utilities = UserDeduction::where('user_id', auth()->user()->id)
            ->where('deduction_name', 'utilities')
            ->pluck('deduction_amount');
        
        $savings = UserDeduction::where('user_id', auth()->user()->id)
            ->where('deduction_name', 'savings')
            ->pluck('deduction_amount');
        
        $totalDailyBudget = 34 * 500;
        
        if ($rent->isNotEmpty() && $utilities->isNotEmpty() && $savings->isNotEmpty()) {
            $rent = $rent->toArray()[0];
            $utilities = $utilities->toArray()[0];
            $savings = $savings->toArray()[0];
            $beforeDailyExpenses = $takeHomePay - $rent - $utilities - $savings;
        } else {
            $rent = 0;
            $utilities = 0;
            $savings = 0;
            $beforeDailyExpenses = 0;
        }
        
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

    public function spending() {

        $expenses = Expense::where('username', auth()->user()->username)
            ->get();

        // dd($expenses);
        return view('budget.spending', compact('expenses'));
    }
}
