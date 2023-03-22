<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class QiwiServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->singleton(BillPayments::class, function ($app) {
            return new BillPayments(config('qiwi.secret_key'));
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
