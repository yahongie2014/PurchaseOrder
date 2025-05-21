<?php

namespace PurchaseOrder;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;
use PurchaseOrder\Services\CurrencyConverter;

class PurchaseOrderServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        // Load migrations and translations
        $this->loadMigrationsFrom(__DIR__ . '/migrations');
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'purchase-order');

        // Publish assets
        $this->publishes([
            __DIR__ . '/resources/lang' => resource_path('lang/vendor/purchase-order'),
        ], 'purchaseorder-lang');

        $this->publishes([
            __DIR__ . '/migrations' => database_path('migrations'),
        ], 'purchaseorder-migrations');

        $this->publishes([
            __DIR__ . '/Models' => app_path('Models/PurchaseOrder'),
        ], 'purchaseorder-models');

        $this->publishes([
            __DIR__ . '/config/purchaseorder.php' => config_path('purchaseorder.php'),
        ], 'purchaseorder-config');

        // Register broadcast channels for Redis
        Broadcast::channel(config('purchaseorder.redis.channel_orders'), function ($user) {
            // Authorization logic if needed, or simply:
            return true;
        });

        Broadcast::channel(config('purchaseorder.redis.channel_products'), function ($user) {
            return true;
        });
    }

    public function register(): void
    {
        // Merge config
        $this->mergeConfigFrom(
            __DIR__ . '/config/purchaseorder.php',
            'purchaseorder'
        );

        // Register CurrencyConverter singleton
        $this->app->singleton(CurrencyConverter::class, function ($app) {
            return new CurrencyConverter();
        });

        // Optional: Bind Redis connection for package usage
        $this->app->singleton('purchaseorder.redis', function ($app) {
            return $app['redis']->connection('default');
        });
    }
}
