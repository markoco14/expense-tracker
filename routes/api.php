<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BudgetController;
use App\Models\Expense;
use App\Models\UserBudget;

// Auth

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('progress', [BudgetController::class, 'percent']);

// Route::get('progress', function() {
            
    // dd(auth()->user());
    // $expenses = Expense::where('username', auth()->user()->username)
    // ->get()
    // ->toArray();

    // return $expenses;
    // $totalSpent = 0;

    // foreach($expenses as &$expense) {
    //     $expense['created_at'] = Carbon\Carbon::parse($expense['created_at'])->toDateString();
    //     if ($expense['created_at'] === Carbon\Carbon::today()->toDateString()) {
    //         array_push($expensesToday, $expense['amount']);
    //         $totalSpent += $expense['amount'];
    //     }
    // }

    // $budget = UserBudget::where('user_id', auth()->user()->id)
    //     ->where('budget_status', 'CURRENT')
    //     ->get()
    //     ->toArray()[0]['budget_amount'];

    // $percentSpent = $totalSpent/$budget*100;
    // return $percentSpent;
    // return response()->json(['data' => $percentSpent], 200);
    // return response()->json([
    //     "response" => "you returned this",
    // ], 200);
//     return json_encode("You returned this.");
// });