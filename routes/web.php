<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ExpensesController;
use App\Http\Controllers\SessionsController;
use App\Http\Controllers\BudgetController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SalaryController;
use App\Http\Controllers\DeductionController;
use App\Http\Controllers\SavingController;
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

Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('index');
    });

    Route::get('/home', function () {
        return redirect('/');
    });

    Route::get('signup', [UsersController::class, 'create']);
    Route::post('signup', [UsersController::class, 'store']);

    Route::get('login', [SessionsController::class, 'create'])->name('login');
    Route::post('sessions', [SessionsController::class, 'store']);
});

Route::middleware('auth')->group(function () { 
    Route::get('logout', [SessionsController::class, 'destroy']);

    Route::get('/home', function () {
        return redirect('tracking');
    });

    Route::prefix('profile')->group(function () {
        Route::get('/', [ProfileController::class, 'index']);
        Route::post('/salaries', [SalaryController::class, 'index']);
        Route::post('/deductions', [DeductionController::class, 'index']);
        Route::post('/savings', [SavingController::class, 'index']);
        Route::post('/budgets', [BudgetController::class, 'index']);
    });

    Route::prefix('tracking')->group(function () {
        Route::get('/', [ExpensesController::class, 'index']);
        Route::post('/', [ExpensesController::class, 'store']);
    });

    Route::get('setup', [BudgetController::class, 'setup']);
    Route::get('spending', [BudgetController::class, 'spending']);
    Route::get('progress', [BudgetController::class, 'progress']);
});