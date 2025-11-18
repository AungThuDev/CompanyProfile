<?php

namespace App\Providers;

use App\Contracts\Backend\CategoryRepositoryInterface;
use App\Contracts\Backend\ProjectRepositoryInterface;
use App\Contracts\Backend\ProjectTypeRepositoryInterface;
use App\Contracts\Backend\ServiceRepositoryInterface;
use App\Contracts\Backend\UserRepositoryInterface;
use App\Repositories\Backend\CategoryRepository;
use App\Repositories\Backend\ProjectRepository;
use App\Repositories\Backend\ProjectTypeRepository;
use App\Repositories\Backend\ServiceRepository;
use App\Repositories\Backend\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $repositories = [
            UserRepositoryInterface::class => UserRepository::class,
            ServiceRepositoryInterface::class => ServiceRepository::class,
            ProjectTypeRepositoryInterface::class => ProjectTypeRepository::class,
            ProjectRepositoryInterface::class => ProjectRepository::class,
            CategoryRepositoryInterface::class => CategoryRepository::class,
        ];

        foreach($repositories as $interface => $implementation) {
            $this->app->bind($interface, $implementation);
        }
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
