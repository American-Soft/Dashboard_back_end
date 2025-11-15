<?php

namespace App\Providers;

use App\Repositories\AuthRepository;
use App\Repositories\BrandRepository;
use App\Repositories\CustomerRepository;
use App\Repositories\EmployeeRepository;
use App\Repositories\interface\AuthRepositoryInterface;
use App\Repositories\interface\BrandRepositoryInterface;
use App\Repositories\interface\CustomerRepositoryInterface;
use App\Repositories\Interface\EmployeeRepositoryInterface;
use App\Repositories\interface\ProductRepositoryInterface;
use App\Repositories\interface\RequestRepositoryInterface;
use App\Repositories\Interface\TransactionRepositoryInterface;
use App\Repositories\Interface\TreasuryRepositoryInterface;
use App\Repositories\interface\UserRepositoryInterface;
use App\Repositories\ProductRepository;
use App\Repositories\RequestRepository;
use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;
use App\Services\AuthService;
use App\Services\BrandService;
use App\Services\CustomerRequestService;
use App\Services\CustomerService;
use App\Services\EmployeeService;
use App\Services\interface\AuthServiceInterface;
use App\Services\interface\BrandServiceInterface;
use App\Services\interface\CustomerRequestServiceInterface;
use App\Services\interface\CustomerServiceInterface;
use App\Services\Interface\EmployeeServiceInterface;
use App\Services\interface\NotificationServiceInterface;
use App\Services\interface\ProductServiceInterface;
use App\Services\interface\RequestServiceInterface;
use App\Services\Interface\TransactionServiceInterface;
use App\Services\interface\UserServiceInterface;
use App\Services\NotificationService;
use App\Services\ProductService;
use App\Services\RequestService;
use App\Services\TransactionService;
use App\Services\TreasuryRepository;
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

        $this->app->bind(
            RequestServiceInterface::class,
            RequestService::class
        );

        $this->app->bind(
            RequestServiceInterface::class,
            RequestService::class
        );

        $this->app->bind(
            RequestRepositoryInterface::class,
            RequestRepository::class
        );

        $this->app->bind(
            CustomerRequestServiceInterface::class,
            CustomerRequestService::class
        );

        $this->app->bind(
            NotificationServiceInterface::class,
            NotificationService::class
        );

        $this->app->bind(
            EmployeeRepositoryInterface::class,
            EmployeeRepository::class
        );

        $this->app->bind(
            EmployeeServiceInterface::class,
            EmployeeService::class
        );

        $this->app->bind(
            TransactionRepositoryInterface::class,
            TransactionRepository::class
        );

        $this->app->bind(
            TreasuryRepositoryInterface::class,
            TreasuryRepository::class
        );

        $this->app->bind(
            TransactionServiceInterface::class,
            TransactionService::class
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
