<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\DeductionController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\SavingController;

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

// PROFILE PAGE API ROUTES
// GET ROUTES
Route::get('profile/salary/get/{userid}/{salary}', [SalaryController::class, 'getUpdatedSalary']);
Route::get('profile/deduction/get/{userid}/{deduction}', [DeductionController::class, 'getUpdatedDeduction']);
Route::get('profile/saving/get/{userid}', [SavingController::class, 'getUpdatedSaving']);
Route::get('profile/budget/get/{userid}', [BudgetController::class, 'getUpdatedBudget']);

// DELETE ROUTES
Route::post('profile/salary/delete/{userid}', [SalaryController::class, 'delete']);
Route::post('profile/deduction/delete/{userid}/{deduction}', [DeductionController::class, 'delete']);
Route::post('profile/saving/delete/{userid}', [SavingController::class, 'delete']);
Route::post('profile/budget/delete/{userid}', [BudgetController::class, 'delete']);
// EDIT ROUTES
Route::post('profile/salary/edit/{userid}/{salary_amount}', [SalaryController::class, 'update']);
Route::post('profile/deduction/edit/{userid}/{deduction}/{amount}/{original_name}', [DeductionController::class, 'update']);
Route::post('profile/saving/edit/{userid}/{saving_amount}', [SavingController::class, 'update']);
Route::post('profile/budget/edit/{userid}/{budget_amount}', [BudgetController::class, 'update']);
// PROGRESS PAGE API ROUTES
Route::get('percent/{username}', [BudgetController::class, 'getTodaySpendingPercent']);