
# PurchaseOrder Laravel Package

A comprehensive Laravel package to manage purchase orders, products, customers, payments, and related entities with full database migrations, seeders, API resources, events, and Laravel Nova admin panel integration.

---
# Package Tree
````
│   composer.json
│   LICENSE
│   README.md
│
└───src
    │   PurchaseOrderServiceProvider.php
    │
    ├───config
    │       purchaseorder.php
    │
    ├───database
    │   ├───factories
    │   │       BrandDetailFactory.php
    │   │       BrandFactory.php
    │   │       CashierFactory.php
    │   │       CategoryDetailFactory.php
    │   │       CategoryFactory.php
    │   │       CurrencyRateFactory.php
    │   │       CustomerFactory.php
    │   │       OrderFactory.php
    │   │       OrderItemFactory.php
    │   │       PaymentFactory.php
    │   │       ProductDetailFactory.php
    │   │       ProductFactory.php
    │   │       ProductImageFactory.php
    │   │       SyncLogFactory.php
    │   │       UserFactory.php
    │   │
    │   ├───migrations
    │   │       2024_01_01_000400_create_customers_table.php
    │   │       2024_01_01_000500_create_cashiers_table.php
    │   │       2024_01_01_000600_create_sync_logs_table.php
    │   │       2024_01_01_000700_create_categories_table.php
    │   │       2024_01_01_000800_create_category_details_table.php
    │   │       2024_01_01_001000_create_brands_table.php
    │   │       2024_01_01_001100_create_brand_details_table.php
    │   │       2024_01_01_0012000_create_products_table.php
    │   │       2024_01_01_0013000_create_product_images_table.php
    │   │       2024_01_01_0014000_create_orders_table.php
    │   │       2024_01_01_0014400_create_order_items_table.php
    │   │       2024_01_01_00145000_create_payments_table.php
    │   │       2025_01_01_00145000_create_currency_rates_table.php
    │   │       2025_01_01_00145000_create_product_details_table.php
    │   │
    │   └───seeders
    │           BrandDetailSeeder.php
    │           BrandSeeder.php
    │           CashierSeeder.php
    │           CategoryDetailSeeder.php
    │           CategorySeeder.php
    │           CurrencyRateSeeder.php
    │           CustomerSeeder.php
    │           OrderItemSeeder.php
    │           OrderSeeder.php
    │           PaymentSeeder.php
    │           ProductDetailSeeder.php
    │           ProductImageSeeder.php
    │           ProductSeeder.php
    │           PurchaseOrderDatabaseSeeder.php
    │           SyncLogSeeder.php
    │
    ├───Events
    │       OrderUpdated.php
    │       ProductUpdated.php
    │
    ├───Http
    │   └───Resources
    │           BrandDetailResource.php
    │           BrandResource.php
    │           CashierResource.php
    │           CategoryDetailResource.php
    │           CategoryResource.php
    │           CustomerResource.php
    │           OrderItemResource.php
    │           OrderResource.php
    │           PaymentResource.php
    │           ProductImageResource.php
    │           ProductResource.php
    │           SyncLogResource.php
    │
    ├───Models
    │       Brand.php
    │       BrandDetail.php
    │       Cashier.php
    │       Category.php
    │       CategoryDetail.php
    │       CurrencyRate.php
    │       Customer.php
    │       Order.php
    │       OrderItem.php
    │       Payment.php
    │       Product.php
    │       ProductDetail.php
    │       ProductImage.php
    │       SyncLog.php
    │
    ├───Nova
    │   │   Brand.php
    │   │   BrandDetail.php
    │   │   Cashier.php
    │   │   Category.php
    │   │   CategoryDetail.php
    │   │   CurrencyRate.php
    │   │   Customer.php
    │   │   Order.php
    │   │   OrderItem.php
    │   │   Payment.php
    │   │   Product.php
    │   │   ProductDetail.php
    │   │   ProductImage.php
    │   │   SyncLog.php
    │   │
    │   ├───Actions
    │   │       MarkAsPaid.php
    │   │       ToggleActiveStatus.php
    │   │
    │   ├───Filters
    │   │       IsActiveFilter.php
    │   │       PaymentStatusFilter.php
    │   │
    │   └───Metrics
    │           OrdersPerDay.php
    │           PaymentStatusPartition.php
    │
    ├───resources
    │   └───lang
    │       ├───ar
    │       │       units.php
    │       │
    │       └───en
    │               units.php
    │
    └───Services
            CurrencyConverter.php
````

## Features

- Fully structured Eloquent models for Brands, Products, Orders, Customers, Payments, and more
- Database migrations and seeders for quick setup
- API Resource classes for clean, consistent API responses
- Laravel Events to hook into Order and Product updates
- Laravel Nova resources with custom actions, filters, and metrics for admin UI
- Currency conversion service
- Multi-language support for units (English and Arabic)
- Well-organized config file to customize package behavior
- Redis broadcast channels for order and product events

---

## Requirements

- PHP >= 8.0
- Laravel >= 9.x (compatible with Nova)
- Laravel Nova (optional, for admin panel features)

---

## Installation

1. **Install the package**

Via Composer (assuming your package repository is registered or use path repository):

```bash
composer require yahongie2014/purchase-order:dev-main
```

2. **Publish package assets**

The package provides multiple publish tags to copy files into your Laravel app. Use these commands depending on what you want to publish:

- Publish config file:

```bash
php artisan vendor:publish --provider="PurchaseOrder\PurchaseOrderServiceProvider" --tag=pos-config
```

- Publish migrations:

```bash
php artisan vendor:publish --provider="PurchaseOrder\PurchaseOrderServiceProvider" --tag=pos-migrations
```

- Publish seeders:

```bash
php artisan vendor:publish --provider="PurchaseOrder\PurchaseOrderServiceProvider" --tag=pos-seeders
```

- Publish model factories:

```bash
php artisan vendor:publish --provider="PurchaseOrder\PurchaseOrderServiceProvider" --tag=pos-factory
```

- Publish Eloquent models:

```bash
php artisan vendor:publish --provider="PurchaseOrder\PurchaseOrderServiceProvider" --tag=pos-models
```

- Publish language files:

```bash
php artisan vendor:publish --provider="PurchaseOrder\PurchaseOrderServiceProvider" --tag=pos-lang
```

- Publish Laravel Nova resources (if you use Nova):

```bash
php artisan vendor:publish --provider="PurchaseOrder\PurchaseOrderServiceProvider" --tag=pos-nova
```

- Publish all assets at once:

```bash
php artisan vendor:publish --provider="PurchaseOrder\PurchaseOrderServiceProvider" --tag=pos-all
```

3. **Run migrations**

```bash
php artisan migrate
```

4. **Run seeders**

To populate the database with sample data, run:

```bash
php artisan db:seed --class="PurchaseOrderDatabaseSeeder"
```

---

## Configuration

Configuration file is published to `config/purchaseorder.php`. Modify this file to adjust package settings such as default currency, pagination, and Redis broadcast channels.

---

## Redis Broadcast Channels

The package uses Redis broadcast channels to push real-time updates for orders and products. These channels are configurable via:

```php
'redis' => [
    'channel_orders' => 'pos-orders',
    'channel_products' => 'pos-products',
],
```

Make sure your Laravel Echo or WebSocket server listens to these channels if you want real-time frontend updates.

---

## Usage

### Models and API Resources

The package provides Eloquent models for:

- Brand, BrandDetail
- Cashier
- Category, CategoryDetail
- CurrencyRate
- Customer
- Order, OrderItem
- Payment
- Product, ProductDetail, ProductImage
- SyncLog

For API responses, use the corresponding Resource classes in:

`PurchaseOrder\Http\Resources`

Example:

```php
use PurchaseOrder\Models\Order;
use PurchaseOrder\Http\Resources\OrderResource;

$order = Order::with('items')->find($id);
return new OrderResource($order);
```

### Events

You can listen to these events:

- `PurchaseOrder\Events\OrderUpdated`
- `PurchaseOrder\Events\ProductUpdated`

Example:

```php
Event::listen(OrderUpdated::class, function ($event) {
    // handle order update
});
```

### Laravel Nova Integration

If you use Laravel Nova, this package provides ready-to-use Nova resources in:

`PurchaseOrder\Nova`

Including custom Actions like:

- MarkAsPaid
- ToggleActiveStatus

Filters like:

- IsActiveFilter
- PaymentStatusFilter

Metrics such as:

- OrdersPerDay
- PaymentStatusPartition

To enable Nova features, register the Nova resources in your `NovaServiceProvider`:

```php
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
```

---

## Extending and Customizing

- Modify or extend Eloquent models by extending the base classes in your app namespace.
- Add custom Nova fields, filters, or actions by extending the provided Nova classes.
- Use the `CurrencyConverter` service to handle currency conversion logic.

---

## Testing

The package includes factories and seeders to facilitate testing. You can use Laravel's built-in testing framework to create feature or unit tests utilizing these factories.

---

## License

This package is open source and licensed under the MIT License. See the LICENSE file for details.

---

## Support

For issues or questions, please open an issue in the package repository or contact the maintainer.

---

Thank you for using the PurchaseOrder package!
