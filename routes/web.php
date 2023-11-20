<?php

use App\Http\Controllers\BarExpenseController;
use App\Http\Controllers\BarSalaryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SaunaController;
use App\Http\Controllers\SaunaExpenseController;
use App\Http\Controllers\SaunaSalaryController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::get('/bar-salaries', BarSalaryController::class)->name('bar-salaries');
    Route::get('/bard-expenses', BarExpenseController::class)->name('bar-expenses');

    Route::get('/sauna-report', SaunaController::class)->name('sauna-report');
    Route::get('/sauna-salaries', SaunaSalaryController::class)->name('sauna-salaries');
    Route::get('/sauna-expenses', SaunaExpenseController::class)->name('sauna-expenses');

    //password changes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
