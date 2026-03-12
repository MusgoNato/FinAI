<?php

namespace App\Providers;

use App\Models\Transaction;
use App\Models\User;
use App\Observers\TransactionObserver;
use App\Observers\UserProfileObserver;
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
        // Observers
        Transaction::observe(TransactionObserver::class);
        User::observe(UserProfileObserver::class);
    }
}
