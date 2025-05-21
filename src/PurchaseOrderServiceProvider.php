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
        ], 'purchaseorder-lang');

        $this->publishes([
            __DIR__ . '/migrations' => database_path('migrations'),
        ], 'purchaseorder-migrations');

        $this->publishes([
            __DIR__ . '/Models' => app_path('Models/PurchaseOrder'),
        ], 'purchaseorder-models');

        // Publish config file
        $this->publishes([
            __DIR__ . '/config/purchaseorder.php' => config_path('purchaseorder.php'),
        ], 'purchaseorder-config');
    }

    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/purchaseorder.php', 'purchaseorder'
        );
        $this->app->singleton(\PurchaseOrder\Services\CurrencyConverter::class, function ($app) {
            return new \PurchaseOrder\Services\CurrencyConverter();
        });

    }
}
