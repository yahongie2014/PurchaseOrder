<?php

namespace PurchaseOrder;

use Illuminate\Support\ServiceProvider;

class PurchaseOrderServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/migrations');
        $this->loadModelsForm(__DIR__ . '/Models');
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'purchase-order');

        $this->publishes([
            __DIR__ . '/resources/lang' => resource_path('lang/vendor/purchase-order'),
        ], 'lang');

        $this->publishes([
            __DIR__ . '/migrations' => database_path('migrations'),
        ], 'Models');
        $this->publishes([
            __DIR__ . '/Models' => app_path('Models/PurchaseOrder'),
        ], 'purchaseorder-models');
    }

    public function register(): void
    {
        // Register bindings or merge configs here if needed
    }
}
