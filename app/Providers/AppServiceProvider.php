<?php

namespace App\Providers;

use App\Models\CompanyInfo;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useTailwind();

        View::composer('layouts.partials.sidebar', function ($view) { 
            $activeCompany = CompanyInfo::where('is_active', true)->first();
            $view->with('activeCompany', $activeCompany);
        });
    }
}
