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
    public function index() {
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
            ->get()
            ->toArray();

        if ($budget === []) {
            $budget = 0;
            $percentSpent = 0;
            $amountRemaining = 0;
        }
        else {
            $budget = $budget[0]['budget_amount'];
            $amountRemaining = $budget - $totalSpent;
            $percentSpent = $totalSpent/$budget*100; // division by zero
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

    public function getTodaySpendingPercent($username) {
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
