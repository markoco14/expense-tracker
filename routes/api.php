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
Route::post('profile/salary/delete/{userid}', [SalaryController::class, 'delete']);
Route::post('profile/deduction/delete/{userid}/{deduction}', [DeductionController::class, 'delete']);
Route::post('profile/saving/delete/{userid}', [SavingController::class, 'delete']);

// PROGRESS PAGE API ROUTES
Route::get('percent/{username}', [BudgetController::class, 'getTodaySpendingPercent']);