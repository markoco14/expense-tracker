<?php

namespace App\Http\Controllers;

use App\Models\UserBudget;
use App\Models\UserSalary;
use App\Models\UserDeduction;
use App\Models\UserSaving;
use App\Services\DeductionCalculatorService;
use Carbon\Carbon;

class ProfileController extends Controller
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
}
