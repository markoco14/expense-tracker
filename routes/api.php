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

// CREATE ROUTES
Route::post('profile/salary/create/{userid}/{salary}', [SalaryController::class, 'create']);
Route::post('profile/deduction/create/{userid}/{deduction_name}/{deduction_amount}', [DeductionController::class, 'create']);
Route::post('profile/saving/create/{userid}/{saving_name}/{saving_amount}', [SavingController::class, 'create']);
Route::post('profile/budget/create/{userid}/{budget_name}/{budget_amount}', [BudgetController::class, 'create']);

// READ ROUTES
Route::get('profile/salary/{userid}', [SalaryController::class, 'getAll']);
Route::get('profile/deduction/{userid}', [DeductionController::class, 'getAll']);
Route::get('profile/savings/{userid}', [SavingController::class, 'getAll']);
Route::get('profile/budgets/{userid}', [BudgetController::class, 'getAll']);

// UPDATE ROUTES
Route::post('profile/salary/edit/{userid}/{salary_id}/{salary_amount}', [SalaryController::class, 'update']);
Route::post('profile/deduction/edit/{userid}/{deduction}/{amount}/{original_name}', [DeductionController::class, 'update']);
Route::post('profile/saving/edit/{userid}/{saving}/{amount}/{original_name}', [SavingController::class, 'update']);
Route::post('profile/budget/edit/{userid}/{id}/{amount}', [BudgetController::class, 'update']);

// DELETE ROUTES
Route::post('profile/salary/delete/{userid}/{salary_id}', [SalaryController::class, 'delete']);
Route::post('profile/deduction/delete/{userid}/{deduction_id}', [DeductionController::class, 'delete']);
Route::post('profile/saving/delete/{userid}/{saving_id}', [SavingController::class, 'delete']);
Route::post('profile/budget/delete/{userid}/{budget_id}', [BudgetController::class, 'delete']);

// PROGRESS PAGE API ROUTES
Route::get('percent/{username}', [BudgetController::class, 'getTodaySpendingPercent']);