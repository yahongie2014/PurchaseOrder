<?php

namespace App\Providers;

use App\Nova\PurchaseOrder\Brand;
use App\Nova\PurchaseOrder\BrandDetail;
use App\Nova\PurchaseOrder\Cashier;
use App\Nova\PurchaseOrder\Category;
use App\Nova\PurchaseOrder\CategoryDetail;
use App\Nova\PurchaseOrder\CurrencyRate;
use App\Nova\PurchaseOrder\Customer;
use App\Nova\PurchaseOrder\Language;
use App\Nova\PurchaseOrder\Order;
use App\Nova\PurchaseOrder\OrderItem;
use App\Nova\PurchaseOrder\Payment;
use App\Nova\PurchaseOrder\Permission;
use App\Nova\PurchaseOrder\Product;
use App\Nova\PurchaseOrder\ProductImage;
use App\Nova\PurchaseOrder\Role;
use App\Nova\PurchaseOrder\SyncLog;
use App\Nova\PurchaseOrder\UserAddress;
use App\Nova\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Traits\Macroable;
use Laravel\Fortify\Features;
use Laravel\Nova\Menu\MenuSection;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        parent::boot();

        Nova::resources([
            Product::class,
            Brand::class,
            Category::class,
            Cashier::class,
            Customer::class,
            Order::class,
            OrderItem::class,
            Payment::class,
            ProductImage::class,
            SyncLog::class,
            CurrencyRate::class,
            Language::class,
        ]);

        Nova::mainMenu(function ($request) {
            return [

                MenuSection::make('Sales', [
                    MenuSection::resource(Order::class)->icon('shopping-cart'),
                    MenuSection::resource(Payment::class)->icon('credit-card'),
                    MenuSection::resource(CurrencyRate::class)->icon('currency-dollar'),
                ])->icon('cash')->collapsible(),

                MenuSection::make('Inventory', [
                    MenuSection::resource(Brand::class)->icon('tag'),
                    MenuSection::resource(Category::class)->icon('collection'),
                    MenuSection::resource(Product::class)->icon('archive'),
                ])->icon('cube')->collapsible(),

                MenuSection::make('Access Control', [
                    MenuSection::resource(Role::class)->icon('shield-check'),
                    MenuSection::resource(Permission::class)->icon('key'),
                ])->icon('lock-closed')->collapsible(),

                MenuSection::make('User Management', [
                    MenuSection::resource(User::class)->icon('user-plus'),
                    MenuSection::resource(Customer::class)->icon('user-group'),
                    MenuSection::resource(Cashier::class)->icon('currency-dollar'),
                    MenuSection::resource(UserAddress::class)->icon('location-marker'),
                ])->icon('users')->collapsible(),

                MenuSection::make('Settings', [
                    MenuSection::resource(Language::class)->icon('language'),
                    MenuSection::resource(SyncLog::class)->icon('exclamation-triangle'),
                ])->icon('cog')->collapsible(),

            ];
        });
    }

    /**
     * Register the configurations for Laravel Fortify.
     */
    protected function fortify(): void
    {
        Nova::fortify()
            ->features([
                Features::updatePasswords(),
                // Features::emailVerification(),
                // Features::twoFactorAuthentication(['confirm' => true, 'confirmPassword' => true]),
            ])
            ->register();
    }

    /**
     * Register the Nova routes.
     */
    protected function routes(): void
    {
        Nova::routes()
            ->withAuthenticationRoutes()
            ->withPasswordResetRoutes()
            ->withoutEmailVerificationRoutes()
            ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     */
    protected function gate(): void
    {
        Gate::define('viewNova', function (User $user) {
            return in_array($user->email, [
                //
            ]);
        });
    }

    /**
     * Get the dashboards that should be listed in the Nova sidebar.
     *
     * @return array<int, \Laravel\Nova\Dashboard>
     */
    protected function dashboards(): array
    {
        return [
            new \App\Nova\Dashboards\Main,
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array<int, \Laravel\Nova\Tool>
     */
    public function tools(): array
    {
        return [];
    }

    /**
     * Register any application services.
     */
    public function register(): void
    {
        parent::register();

        //
    }
}
