<?php

use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\DashboardController;
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

Route::redirect('/', '/dashboard');

// Dashboard (Protected Routes)
Route::middleware('auth')->group(function () { 
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');
    });

    // Logout
     Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

// Auth Routes (Guest Only)
Route::prefix('auth')->name('auth.')->group(function () {
    Route::match(['get', 'post'], 'login', [AuthController::class, 'login'])->name('login');

    Route::match(['get', 'post'], 'forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password');

    Route::match(['get', 'post'], 'reset-password', [AuthController::class, 'resetPassword'])->name('reset-password');

    Route::match(['get', 'post'], 'verify-email', [AuthController::class, 'verifyEmail'])->name('verify-email');

    Route::post('resend-email', [AuthController::class, 'resendEmail'])->name('resend-email');

});

