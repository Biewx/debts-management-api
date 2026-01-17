<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Debts\DebtRepository;
use App\Domain\Payments\PaymentRepository;
use App\Infrastructure\Persistence\Eloquent\EloquentDebtRepository;
use App\Infrastructure\Persistence\Eloquent\EloquentPaymentRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
        DebtRepository::class,
        EloquentDebtRepository::class
        );

        $this->app->bind(
        PaymentRepository::class,
        EloquentPaymentRepository::class
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