<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
// Import các Contracts
use App\Contracts\AuthorRepositoryInterface;
use App\Contracts\BookRepositoryInterface;
use App\Contracts\BorrowingRepositoryInterface;
use App\Contracts\CategoryRepositoryInterface;
use App\Contracts\FineRepositoryInterface;
use App\Contracts\PublisherRepositoryInterface;
use App\Contracts\UserRepositoryInterface;

// Import các Implementations
use App\Repositories\AuthorRepository;
use App\Repositories\BookRepository;
use App\Repositories\BorrowingRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\FineRepository;
use App\Repositories\PublisherRepository;
use App\Repositories\UserRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(AuthorRepositoryInterface::class, AuthorRepository::class);
        $this->app->bind(BookRepositoryInterface::class, BookRepository::class);
        $this->app->bind(BorrowingRepositoryInterface::class, BorrowingRepository::class);
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(FineRepositoryInterface::class, FineRepository::class);
        $this->app->bind(PublisherRepositoryInterface::class, PublisherRepository::class);
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
