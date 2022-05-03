<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\FinancialsController;
use Illuminate\Contracts\Session\Session;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

// sign up page routes
Route::get('signup', [UsersController::class, 'create'])->middleware('guest');
Route::post('signup', [UsersController::class, 'store'])->middleware('guest');

// log in page routes
Route::get('login', [SessionsController::class, 'create'])->middleware('guest')->name('login');
Route::post('sessions', [SessionsController::class, 'store'])->middleware('guest');

// log out
Route::get('logout', [SessionsController::class, 'destroy'])->middleware('auth');

// profile information routes
Route::get('profile', [FinancialsController::class, 'index'])->middleware('auth');
Route::post('profile/store', [FinancialsController::class, 'store'])->middleware('auth');
Route::post('profile/salaries', [FinancialsController::class, 'salaries'])->middleware('auth');
Route::post('profile/deductions', [FinancialsController::class, 'deductions'])->middleware('auth');
Route::post('profile/savings', [FinancialsController::class, 'savings'])->middleware('auth');
Route::post('profile/budgets', [FinancialsController::class, 'budgets'])->middleware('auth');

// expense input routes
Route::get('tracking', [ExpensesController::class, 'index'])->middleware('auth');
Route::post('tracking', [ExpensesController::class, 'store'])->middleware('auth');

// budget routes
Route::get('details', [BudgetController::class, 'index'])->middleware('auth');
Route::get('setup', [BudgetController::class, 'setup'])->middleware('auth');
Route::get('spending', [BudgetController::class, 'spending'])->middleware('auth');