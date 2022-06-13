<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\UserBudget;
use App\Models\UserDeduction;
use App\Models\UserSalary;
use Illuminate\Http\Request;
use App\Services\DeductionCalculatorService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class BudgetController extends Controller
{

    public function index(DeductionCalculatorService $deductionCalculatorService) {
        $monthlySalary = $deductionCalculatorService->getSalary();
        $labourInsurance = $deductionCalculatorService->getLabourInsurance();
        $nationalHealthInsurance = $deductionCalculatorService->getNationalHealthInsruance();
        $allDeductions = $deductionCalculatorService->getDeductions();
        $deductions = 0;
        foreach ($allDeductions as $deduction) {
            $deductions += $deduction['deduction_amount'];
        }
        $takeHomePay = $monthlySalary - $deductions;
        // $rent = $deductionCalculatorService->getRent();
        // $utilities = $deductionCalculatorService->getUtilities();
        $savings = $deductionCalculatorService->getSavings();
        $beforeDailyExpenses = $takeHomePay - $savings;
        $totalDailyBudget = $deductionCalculatorService->getDailyBudget();
        $budgetedMonthlyExpenses = $totalDailyBudget * Carbon::now()->daysInMonth;
        $surplus = $beforeDailyExpenses - $budgetedMonthlyExpenses;
        
        return view('budget.details', [
            'monthlySalary' => number_format($monthlySalary),
            'deductions' => number_format($deductions),
            'labourInsurance' => number_format($labourInsurance),
            'nationalHealthInsurance' => number_format($nationalHealthInsurance),
            'takeHomePay' => number_format($takeHomePay),
            // 'rent' => number_format($rent),
            // 'utilities's => number_format($utilities),
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

        return view('budget.spending', compact('expenses'));
    }

    public function progress() {

        $expenses = Expense::where('username', auth()->user()->username)
            ->get()
            ->toArray();

        $expensesToday = [];
        $totalSpent = 0;
        
        foreach($expenses as &$expense) {
            $expense['created_at'] = Carbon::parse($expense['created_at'])->toDateString();
            if ($expense['created_at'] === Carbon::today()->toDateString()) {
                array_push($expensesToday, $expense['amount']);
                $totalSpent += $expense['amount'];
            }
        }

        $budget = UserBudget::where('user_id', auth()->user()->id)
            ->where('budget_status', 'CURRENT')
            ->get()
            ->toArray()[0]['budget_amount'];

        $amountRemaining = $budget - $totalSpent;
        $percentSpent = $totalSpent/$budget*100;
        // dd(json_encode($percentSpent));
        // dd($amountRemaining);

        $today = Carbon::today();


        return view('progress', [
            'expenses' => $expensesToday,
            'budget' => $budget,
            'remaining' => $amountRemaining,
            'percent' => $percentSpent,
            'today' => $today
        ]);
    }

    public function getTodaySpendingPercent($username) {
        // return json_encode($username);
        // $expenses = Expense::where('username', auth()->user()->username)
        //     ->get()
        //     ->toArray();

        // return $expenses;
        
        $expenses = Expense::get()
        ->where('username', $username);
        $totalSpent = 0;
        
        foreach($expenses as &$expense) {
            if (Carbon::parse($expense['created_at'])->toDateString() === Carbon::today()->toDateString()) {
                $totalSpent += $expense['amount'];
            }
        }

        return json_encode($totalSpent);
    }

    public function delete($userid) {
        UserBudget::where('user_id', $userid)
        ->where('budget_status', 'CURRENT')
        ->update(['budget_status' => 'OOD']);
    }
}
