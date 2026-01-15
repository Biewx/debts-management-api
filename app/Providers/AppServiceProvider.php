<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Domain\Debts\DebtRepository;
use App\Infrastructure\Persistence\Eloquent\EloquentDebtRepository;

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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}