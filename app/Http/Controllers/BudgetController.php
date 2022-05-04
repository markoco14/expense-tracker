<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\UserDeduction;
use App\Models\UserSalary;
use Illuminate\Http\Request;
use App\Services\DeductionCalculatorService;
use Carbon\Carbon;

class BudgetController extends Controller
{

    public function index(DeductionCalculatorService $deductionCalculatorService) {

        $monthlySalary = UserSalary::where('user_id', auth()->user()->id)
            ->pluck('salary_amount');
        if ($monthlySalary->isNotEmpty()) {
            $monthlySalary = $monthlySalary->toArray()[0];
        } else {
            $monthlySalary = 0;
        }
        
        $labourInsurance = $deductionCalculatorService->getLabourInsurance();
        $nationalHealthInsurance = $deductionCalculatorService->getNationalHealthInsruance();
        $allDeductions = $deductionCalculatorService->getDeductions();
        $deductions = 0;
        foreach ($allDeductions as $deduction) {
            $deductions += $deduction['deduction_amount'];
        }
        $takeHomePay = $monthlySalary - $deductions;
        $rent = $deductionCalculatorService->getRent();
        $utilities = $deductionCalculatorService->getUtilities();
        $savings = $deductionCalculatorService->getSavings();
        $beforeDailyExpenses = $takeHomePay - $rent - $utilities - $savings;
        $totalDailyBudget = $deductionCalculatorService->getDailyBudget();
        $budgetedMonthlyExpenses = $totalDailyBudget * Carbon::now()->daysInMonth;
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
            'totalDailyBudget' => number_format($budgetedMonthlyExpenses),
            'surplus' => number_format($surplus),
            'allDeductions' => $allDeductions
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
