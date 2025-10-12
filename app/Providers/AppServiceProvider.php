<?php

namespace App\Providers;

use App\Repositories\AuthRepository;
use App\Repositories\BrandRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\interface\AuthRepositoryInterface;
use App\Repositories\interface\BrandRepositoryInterface;
use App\Repositories\interface\CustomerRepositoryInterface;
use App\Repositories\interface\ProductRepositoryInterface;
use App\Repositories\interface\UserRepositoryInterface;
use App\Repositories\ProductRepository;
use App\Repositories\UserRepository;
use App\Services\AuthService;
use App\Services\BrandService;
use App\Services\CustomerService;
use App\Services\interface\AuthServiceInterface;
use App\Services\interface\BrandServiceInterface;
use App\Services\interface\CustomerServiceInterface;
use App\Services\interface\ProductServiceInterface;
use App\Services\interface\UserServiceInterface;
use App\Services\ProductService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {

        $this->app->bind(
            BrandServiceInterface::class,
            BrandService::class
        );

        $this->app->bind(
            BrandRepositoryInterface::class,
            BrandRepository::class
        );

        $this->app->bind(
            ProductServiceInterface::class,
            ProductService::class
        );
        
        $this->app->bind(
            ProductRepositoryInterface::class,
            ProductRepository::class
        );

        $this->app->bind(
            AuthServiceInterface::class,
            AuthService::class
        );

        $this->app->bind(
            AuthRepositoryInterface::class,
            AuthRepository::class
        );

        $this->app->bind(
            UserServiceInterface::class,
            UserService::class
        );

        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        $this->app->bind(
            CustomerServiceInterface::class,
            CustomerService::class
        );

        $this->app->bind(
            CustomerRepositoryInterface::class,
            CustomerRepository::class
        );

    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
