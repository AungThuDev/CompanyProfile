<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\{
    ArticleController,
    AuthController,
    CategoryController,
    CompanyInfoController,
    ContactMessageController,
    DashboardController,
    ProjectController,
    ProjectTypeController,
    ServiceController,
    SocialAccountController,
    TagController,
    UserController
};
use App\Http\Controllers\Frontend\FrontendController;

/*
|--------------------------------------------------------------------------
| Backend Routes (Dashboard & Auth)
|--------------------------------------------------------------------------
|
| Routes for admin panel, protected by auth middleware
|
*/

// Dashboard (Protected Routes)
Route::middleware('auth')->prefix('dashboard')->name('dashboard.')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('index');

    // User management
    Route::prefix('users')->name('users.')->controller(UserController::class)->group(function () {
        Route::get('', 'index')->name('index');
        Route::get('create', 'create')->name('create');
        Route::post('', 'store')->name('store');
        Route::get('/{user}', 'show')->name('show');
        Route::patch('/{user}/suspend', 'suspend')->name('suspend');
    });

    // Profile
    Route::match(['get', 'patch'], 'profile', [UserController::class, 'profile'])->name('profile');

    // Settings
    Route::get('/settings', [UserController::class, 'settings'])->name('settings');
    Route::post('/settings/password', [UserController::class, 'changePassword'])->name('settings.password');

    // Resources
    Route::resources([
        'services'        => ServiceController::class,
        'project-types'   => ProjectTypeController::class,
        'projects'        => ProjectController::class,
        'categories'      => CategoryController::class,
        'tags'            => TagController::class,
        'articles'        => ArticleController::class,
        'company-infos'   => CompanyInfoController::class,
        'social-accounts' => SocialAccountController::class,
    ]);

    Route::prefix('contacts')->name('contacts.')->controller(ContactMessageController::class)->group(function () { 
        Route::get('', 'index')->name('index');
        Route::get('/{id}', 'show')->name('show');
        Route::post('/{id}/reply', 'reply')->name('reply');
        Route::delete('/{id}', 'destroy')->name('destroy');
    });

});

// Logout
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Auth Routes (Guest Only)
Route::prefix('auth')->name('auth.')->controller(AuthController::class)->group(function () {
    Route::match(['get', 'post'], 'login', 'login')->name('login');
    Route::match(['get', 'post'], 'forgot-password', 'forgotPassword')->name('forgot-password');
    Route::match(['get', 'post'], 'reset-password', 'resetPassword')->name('reset-password');
    Route::match(['get', 'post'], 'verify-email', 'verifyEmail')->name('verify-email');
    Route::post('resend-email', 'resendEmail')->name('resend-email');
});


/*
|--------------------------------------------------------------------------
| Frontend SPA Routes
|--------------------------------------------------------------------------
|
| All frontend routes handled by Vue SPA.
| Page refreshes will not cause 404 because backend routes are excluded.
|
*/
Route::get('/{any}', [FrontendController::class, 'index'])
     ->where('any', '^(?!dashboard|auth).*$'); // exclude backend paths
