<?php

namespace PurchaseOrder;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;
use Laravel\Nova\Nova;
use PurchaseOrder\Services\CurrencyConverter;

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

        $this->publishes([
            __DIR__ . '/config/purchaseorder.php' => config_path('purchaseorder.php'),
        ], 'purchaseorder-config');


        Broadcast::channel(config('purchaseorder.redis.channel_orders'), function ($user) {
            return true;
        });

        Broadcast::channel(config('purchaseorder.redis.channel_products'), function ($user) {
            return true;
        });

        if (class_exists(Nova::class)) {
            $this->publishes([
                __DIR__ . '/Nova' => app_path('Nova/PurchaseOrder'),
            ], 'purchaseorder-nova');

            Nova::resources([
                \PurchaseOrder\Nova\Product::class,
                \PurchaseOrder\Nova\Brand::class,
                \PurchaseOrder\Nova\BrandDetail::class,
                \PurchaseOrder\Nova\Category::class,
                \PurchaseOrder\Nova\CategoryDetail::class,
                \PurchaseOrder\Nova\Cashier::class,
                \PurchaseOrder\Nova\Customer::class,
                \PurchaseOrder\Nova\Order::class,
                \PurchaseOrder\Nova\OrderItem::class,
                \PurchaseOrder\Nova\Payment::class,
                \PurchaseOrder\Nova\ProductImage::class,
                \PurchaseOrder\Nova\SyncLog::class,
                \PurchaseOrder\Nova\CurrencyRate::class,
            ]);
        }
    }

    public function register(): void
    {
        $this->mergeConfigFrom(
            __DIR__ . '/config/purchaseorder.php',
            'purchaseorder'
        );

        $this->app->singleton(CurrencyConverter::class, function ($app) {
            return new CurrencyConverter();
        });

        $this->app->singleton('purchaseorder.redis', function ($app) {
            return $app['redis']->connection('default');
        });
    }
}
