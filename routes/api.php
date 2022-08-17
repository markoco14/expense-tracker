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

Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::prefix('profile')->group(function() {
        // LIST ROUTES
        Route::get('/salaryList', [SalaryController::class, 'getAll']);
        Route::get('/deductionList', [DeductionController::class, 'getAll']);
        Route::get('/savingList', [SavingController::class, 'getAll']);
        Route::get('/budgetList', [BudgetController::class, 'getAll']);

        // CREATE ROUTES

        // UPDATE ROUTES

        // DELETE ROUTES
    });

});

// CREATE ROUTES
Route::post('profile/salary/create/{userid}/{salary_name}/{salary_amount}', [SalaryController::class, 'create']);
Route::post('profile/deduction/create/{userid}/{deduction_name}/{deduction_amount}', [DeductionController::class, 'create']);
Route::post('profile/saving/create/{userid}/{saving_name}/{saving_amount}', [SavingController::class, 'create']);
Route::post('profile/budget/create/{userid}/{budget_name}/{budget_amount}', [BudgetController::class, 'create']);

// UPDATE ROUTES
Route::post('profile/salary/edit/{userid}/{salary_id}/{salary_name}/{salary_amount}', [SalaryController::class, 'update']);
Route::post('profile/deduction/edit/{userid}/{deduction}/{amount}/{original_name}', [DeductionController::class, 'update']);
Route::post('profile/saving/edit/{userid}/{saving}/{amount}/{original_name}', [SavingController::class, 'update']);
Route::post('profile/budget/edit/{userid}/{id}/{amount}', [BudgetController::class, 'update']);

// DELETE ROUTES
Route::post('profile/salary/delete/{userid}/{salary_id}', [SalaryController::class, 'delete']);
Route::post('profile/deduction/delete/{userid}/{deduction_id}', [DeductionController::class, 'delete']);
Route::post('profile/saving/delete/{userid}/{saving_id}', [SavingController::class, 'delete']);
Route::post('profile/budget/delete/{userid}/{budget_id}', [BudgetController::class, 'delete']);








// PROGRESS PAGE API ROUTES
// Route::get('percent/{username}/{userid}', [BudgetController::class, 'getTodaySpendingPercent']);


Route::group(['middleware' => ['auth:sanctum']], function() {
    Route::get('percent', [BudgetController::class, 'getTodaySpendingPercent']);
});