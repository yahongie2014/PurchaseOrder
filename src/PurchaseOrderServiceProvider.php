<?php

namespace PurchaseOrder;

use Illuminate\Support\ServiceProvider;

class PurchaseOrderServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/migrations');
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'purchase-order');
        $this->publishes([
            __DIR__ . '/resources/lang' => resource_path('lang/vendor/purchase-order'),
        ], 'lang');
    }

    public function register(): void
    {
        //
    }
}
