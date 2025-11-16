<?php

use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\ProjectController;
use App\Http\Controllers\Backend\ProjectTypeController;
use App\Http\Controllers\Backend\ServiceController;
use App\Http\Controllers\Backend\UserController;
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

        Route::prefix('users')
        ->name('users.')
        ->controller(UserController::class)
        ->group(function () {   
            Route::get('', 'index')->name('index');
            Route::get('create', 'create')->name('create');
            Route::post('', 'store')->name('store');
            Route::get('/{user}', 'show')->name('show');
            Route::patch('/{user}/suspend', 'suspend')->name('suspend');
        });

        Route::match(['get', 'patch'], 'profile', [UserController::class, 'profile'])->name('profile');

        Route::resource('services', ServiceController::class);
        Route::resource('project-types', ProjectTypeController::class);
        Route::resource('projects', ProjectController::class);
    });

    // Logout
     Route::post('logout', [AuthController::class, 'logout'])->name('logout');
});

// Auth Routes (Guest Only)
Route::prefix('auth')->name('auth.')->controller(AuthController::class)->group(function () {
    Route::match(['get', 'post'], 'login', 'login')->name('login');
    Route::match(['get', 'post'], 'forgot-password', 'forgotPassword')->name('forgot-password');
    Route::match(['get', 'post'], 'reset-password', 'resetPassword')->name('reset-password');
    Route::match(['get', 'post'], 'verify-email', 'verifyEmail')->name('verify-email');
    Route::post('resend-email', 'resendEmail')->name('resend-email');
});

