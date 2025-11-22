<?php

namespace App\Providers;

use App\Repositories\TagRepository;
use App\Repositories\UserRepository;
use App\Repositories\ArticleRepository;
use App\Repositories\ProjectRepository;
use App\Repositories\ServiceRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\CategoryRepository;
use App\Contracts\TagRepositoryInterface;
use App\Repositories\ContactUsRepository;
use App\Contracts\UserRepositoryInterface;
use App\Repositories\CompanyInfoRepository;
use App\Repositories\ProjectTypeRepository;
use App\Contracts\ArticleRepositoryInterface;
use App\Contracts\ProjectRepositoryInterface;
use App\Contracts\ServiceRepositoryInterface;
use App\Repositories\SocialAccountRepository;
use App\Contracts\CategoryRepositoryInterface;
use App\Contracts\ContactUsRepositoryInterface;
use App\Contracts\CompanyInfoRepositoryInterface;
use App\Contracts\ProjectTypeRepositoryInterface;
use App\Contracts\SocialAccountRepositoryInterface;

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
            TagRepositoryInterface::class => TagRepository::class,
            ArticleRepositoryInterface::class => ArticleRepository::class,
            CompanyInfoRepositoryInterface::class => CompanyInfoRepository::class,
            SocialAccountRepositoryInterface::class => SocialAccountRepository::class,
            ContactUsRepositoryInterface::class => ContactUsRepository::class,
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
