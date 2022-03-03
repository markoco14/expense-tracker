<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BudgetController extends Controller
{
    public function index() {
        $monthlySalary = 53000;
        $labourInsurance = 962;
        $nationalHealthInsurance = 822;
        $deductions = $labourInsurance + $nationalHealthInsurance;
        $takeHomePay = $monthlySalary - $deductions;
        $rent = 16800;
        $utilities = 1035;
        $savings = 15000;
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
}
