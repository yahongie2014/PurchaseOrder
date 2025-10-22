<?php

namespace PurchaseOrder;

use Illuminate\Support\Facades\File;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Broadcast;
use Laravel\Nova\Nova;
use PurchaseOrder\Services\CurrencyConverter;

class PurchaseOrderServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $source = __DIR__ . '/Nova/Repeaters';
        $destination = app_path('Nova/Repeaters');

        // Only copy package repeaters if they exist in the package
        if (File::exists($source)) {
            if (!File::exists($destination)) {
                File::makeDirectory($destination, 0755, true);
            }

            File::copyDirectory($source, $destination);
        }

        $this->loadMigrationsFrom(__DIR__ . '/migrations');
        $this->loadTranslationsFrom(__DIR__ . '/resources/lang', 'pos');

        $publishedRoutesPath = base_path('routes/vendor/purchaseorder/web.php');
        if (file_exists($publishedRoutesPath)) {
            $this->loadRoutesFrom($publishedRoutesPath);
        } else {
            $this->loadRoutesFrom(__DIR__ . '/routes/web.php');
        }

        $publishedApiRoutesPath = base_path('routes/vendor/purchaseorder/api.php');
        if (file_exists($publishedApiRoutesPath)) {
            $this->loadRoutesFrom($publishedApiRoutesPath);
        } elseif (file_exists(__DIR__ . '/routes/api.php')) {
            $this->loadRoutesFrom(__DIR__ . '/routes/api.php');
        }

        $this->loadViewsFrom(__DIR__ . '/resources/views', 'purchaseorder');

        $this->publishes([
            __DIR__ . '/Policies' => app_path('Policies'),
        ], 'pos-policies');

        $this->publishes([
            __DIR__ . '/resources/lang' => resource_path('lang/vendor/purchase-order'),
        ], 'pos-lang');

        $this->publishes([
            __DIR__ . '/database/migrations' => database_path('migrations'),
        ], 'pos-migrations');

        $this->publishes([
            __DIR__ . '/Models' => app_path('Models/PurchaseOrder'),
        ], 'pos-models');

        $this->publishes([
            __DIR__ . '/config/purchaseorder.php' => config_path('purchaseorder.php'),
        ], 'pos-config');

        $this->publishes([
            __DIR__ . '/database/seeders' => database_path('seeders'),
        ], 'pos-seeders');

        $this->publishes([
            __DIR__ . '/database/factories' => database_path('factories'),
        ], 'pos-factory');

        $this->publishes([
            __DIR__ . '/resources/views' => resource_path('views/vendor/purchaseorder'),
        ], 'pos-views');

        $this->publishes([
            __DIR__ . '/routes' => base_path('routes/vendor/purchaseorder'),
        ], 'pos-routes');

        $this->publishes([
            __DIR__ . '/Http/Controllers' => app_path('Http/Controllers/PurchaseOrder'),
        ], 'pos-controllers');

        $this->publishes([
            __DIR__ . '/Http/Resources' => app_path('Http/Resources/PurchaseOrder'),
        ], 'pos-api-resources');

        Broadcast::channel(config('purchaseorder.redis.channel_orders'), function ($user) {
            return true;
        });

        Broadcast::channel(config('purchaseorder.redis.channel_products'), function ($user) {
            return true;
        });

        // Register publish mappings for Nova resources and provider.
        // We do not auto-copy provider files into the application during boot.
        $this->publishes([
            __DIR__ . '/Nova' => base_path('app/Nova/PurchaseOrder'),
            __DIR__ . '/Providers/NovaServiceProvider.php' => app_path('Providers/NovaServiceProvider.php'),
        ], 'pos-nova');
        // Do not auto-run vendor:publish during boot; leave publishable resources registered for manual publishing.

        // If Spatie Permission is available, locate its package path and register
        // its config and migrations so they can be published together with 'pos-all'.
        if (class_exists(\Spatie\Permission\PermissionServiceProvider::class)) {
            try {
                $ref = new \ReflectionClass(\Spatie\Permission\PermissionServiceProvider::class);
                $spatieBase = dirname($ref->getFileName(), 2); // vendor/spatie/laravel-permission

                if (File::exists($spatieBase)) {
                    $map = [];
                    if (File::exists($spatieBase . '/config/permission.php')) {
                        $map[$spatieBase . '/config/permission.php'] = config_path('permission.php');
                    }
                    if (File::exists($spatieBase . '/database/migrations')) {
                        $map[$spatieBase . '/database/migrations'] = database_path('migrations');
                    }

                    if (!empty($map)) {
                        $this->publishes($map, 'pos-all');
                    }
                }
            } catch (\ReflectionException $e) {
                // ignore; Spatie not available or reflection failed
            }
        }

        $this->publishes([
            __DIR__ . '/config/purchaseorder.php' => config_path('purchaseorder.php'),
            __DIR__ . '/database/migrations' => database_path('migrations'),
            __DIR__ . '/database/factories' => database_path('factories'),
            __DIR__ . '/database/seeders' => database_path('seeders'),
            __DIR__ . '/database/seeders/DatabaseSeeder.php' => database_path('seeders/DatabaseSeeder.php'),
            __DIR__ . '/resources/lang' => resource_path('lang/vendor/purchase-order'),
            __DIR__ . '/Models' => app_path('Models/PurchaseOrder'),
            __DIR__ . '/Repositories' => app_path('Repositories/PurchaseOrder'),
            __DIR__ . '/Policies' => app_path('Policies'),
            __DIR__ . '/Http/Resources' => app_path('Http/Resources/PurchaseOrder'),
        ], ['pos-all' => ['force' => true]]);

        // Allow publishing Repositories folder independently
        $this->publishes([
            __DIR__ . '/Repositories' => app_path('Repositories/PurchaseOrder'),
        ], 'pos-repositories');

        $this->publishes([
            __DIR__ . '/resources/views' => resource_path('views/vendor/purchaseorder'),
            __DIR__ . '/routes' => base_path('routes/vendor/purchaseorder'),
            __DIR__ . '/Http/Controllers' => app_path('Http/Controllers/PurchaseOrder'),
        ], 'pos-test');


        // Intentionally do not call vendor:publish automatically.
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

        // Repository bindings
        $this->app->bind(
            \PurchaseOrder\Repositories\Contracts\ProductRepositoryInterface::class,
            \PurchaseOrder\Repositories\Eloquent\EloquentProductRepository::class
        );

        $this->app->bind(
            \PurchaseOrder\Repositories\Contracts\OrderRepositoryInterface::class,
            \PurchaseOrder\Repositories\Eloquent\EloquentOrderRepository::class
        );

        // Register package console commands
        if ($this->app->runningInConsole()) {
            $this->commands([
                \PurchaseOrder\Console\InstallPurchaseOrder::class,
            ]);
        }
    }
}
