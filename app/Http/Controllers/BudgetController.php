<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\UserBudget;
use Carbon\CarbonPeriod;
use Carbon\Carbon;

class BudgetController extends Controller
{
    public function setup() {
        return view('budget.setup');
    }

    public function spending() {
        $period = CarbonPeriod::create('2022-06-01', '2022-06-30');
        $dates = [];
        
        $expenses = Expense::where('username', auth()->user()->username)
        // ->whereDate('created_at', '=', Carbon::today()->toDateString())
        ->get()
        ->toArray();
        // dd($expenses);

        // foreach($period as $date) {
        //     array_push($dates, $date->toDateString());
        // }

        if ($expenses !== []) {
            $monthlyExpenses = [];
            $totalSpending = 0;
            foreach ($expenses as $expense) {
                // dd($expense['created_at'], Carbon::parse($expense['created_at'])->timezone('Asia/Taipei'));   
                $date = Carbon::parse($expense['created_at'])->timezone('Asia/Taipei');
                // dd($date);
                if ($date->month === Carbon::today()->month 
                    && $date->year === Carbon::today()->year){
                        array_push($monthlyExpenses, $expense);
                        $totalSpending += $expense['amount'];
                }
            }
        } else {
            $monthlyExpenses = [];
            $totalSpending = 0;
        }

        foreach ($monthlyExpenses as $expense) {
            array_push ($dates, Carbon::parse($expense['created_at'])->toDateString());
        }
        $dates = array_unique($dates);
        foreach ($dates as &$date) {
            $date = Carbon::parse($date);
        }


        return view('budget.spending', [
            'expenses' => $monthlyExpenses,
            'totalSpending' => $totalSpending,
            'dates' => $dates,
        ]);
    }

    public function progress() {

        $expenses = Expense::where('username', auth()->user()->username)
            ->get()
            ->toArray();
        $expensesToday = [];
        $totalSpent = 0;

        if ($expenses !== []) {
            foreach($expenses as &$expense) {
                $expense['created_at'] = Carbon::parse($expense['created_at'])->toDateString();
                if ($expense['created_at'] === Carbon::today()->toDateString()) {
                    array_push($expensesToday, $expense['amount']);
                    $totalSpent += $expense['amount'];
                }
            }
        }

        $budget = UserBudget::where('user_id', auth()->user()->id)
            ->where('budget_name', 'Daily')
            ->where('budget_status', 'CURRENT')
            ->get()
            ->toArray();

        if($budget[0]['budget_amount'] === 0 && $totalSpent === 0) {
            $budget = $budget[0]['budget_amount'];
            $amountRemaining = 0;
            $percentSpent = 0;
        } elseif ($budget[0]['budget_amount'] === 0 && $totalSpent > 0){
            $budget = $budget[0]['budget_amount'];
            $amountRemaining = $budget - $totalSpent;
            $percentSpent = -100;
        } else {
            $budget = $budget[0]['budget_amount'];
            $amountRemaining = $budget - $totalSpent;
            $percentSpent = $totalSpent/$budget*100;
        }

        $today = Carbon::today();

        return view('progress', [
            'expenses' => $expensesToday,
            'budget' => $budget,
            'remaining' => $amountRemaining,
            'percent' => $percentSpent,
            'today' => $today
        ]);
    }

    public function getTodaySpendingPercent() {
        $userId = auth()->user()->id;
        $budgetData = UserBudget::where('user_id', $userId)
        ->where('budget_status', 'CURRENT')
        ->get();
        $budgetAmount = $budgetData[0]['budget_amount'];

        $expenses = Expense::where('user_id', $userId)
        ->get();
        $totalSpent = 0;
        
        foreach($expenses as &$expense) {
            if (Carbon::parse($expense['created_at'])->toDateString() === Carbon::today()->toDateString()) {
                $totalSpent += $expense['amount'];
            }
        }

        return json_encode([
            'totalSpent' => $totalSpent,
            'budgetAmount' => $budgetAmount
        ]);
    }

    public function getAll($userid) {
        $budgetCollection = UserBudget::where('user_id', $userid)
        ->where('budget_status', 'CURRENT')
        ->get();
        $budget = $budgetCollection->toArray();
        return json_encode($budget);
    }

    public function create($userid, $label, $amount) {
        $budget = new UserBudget;
        $budget->user_id = $userid;
        $budget->budget_name = $label;
        $budget->budget_status = 'CURRENT';
        $budget->budget_amount = $amount;
        $budget->save();
        return ['success' => 200];
    } 

    public function update($userid, $id, $amount) {
        UserBudget::where('user_id', $userid)
        ->where('id', $id)
        ->update(['budget_amount' => $amount]);
        return ['status' => 201];
    }

    public function getUpdatedBudget($userid) {
        $budget = UserBudget::where('user_id', $userid)
        ->where('budget_status', 'CURRENT')
        ->get();
        return json_encode($budget);
    }

    public function delete($userid, $id) {
        UserBudget::where('user_id', $userid)
        ->where('id', $id)
        ->update(['budget_status' => 'OOD']);
        return ['success', 200];
    }
}
