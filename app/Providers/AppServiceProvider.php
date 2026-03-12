<?php

namespace App\Providers;

use App\Models\Transaction;
use App\Observers\Observers\TransactionObersver;
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
        Transaction::observe(TransactionObersver::class);
    }
}
