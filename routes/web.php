<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ExpensesController;

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
    return view('welcome');
});

// expense input routes
Route::get('record', [ExpensesController::class, 'index']);

// sign up page routes
Route::get('signup', [UsersController::class, 'index']);

Route::post('signup', [UsersController::class, 'register']);

// log in page routes
