
# PurchaseOrder Laravel Package

A flexible, ready-to-use Point of Sale (POS) and product management package for Laravel, supporting multilingual data, extensible Eloquent models, migrations, API resources, and comprehensive database seeding.

---

## Features

- Full eCommerce-ready database schema (Products, Orders, Payments, etc.)
- Multilingual support for Brands and Categories
- Modular Eloquent models (can be published/overridden)
- API Resource classes for clean JSON responses
- Seeder and Factory files for realistic test data
- Publishable migrations and translations

---

## Installation

1. **Require the package via Composer**

   ```bash
   composer require yahongie2014/purchase-order:dev-main
   ```

   > _Note: Ensure your `composer.json` includes the VCS repository and correct minimum-stability if using a GitHub package._

2. **(Optional) Publish migrations, translations, and models**

   ```bash
   php artisan vendor:publish --tag=purchaseorder-migrations
   php artisan vendor:publish --tag=purchaseorder-lang
   php artisan vendor:publish --tag=purchaseorder-models
   ```

---

## Usage

- **Migrate the database**  
  ```bash
  php artisan migrate
  ```

- **Seed sample data**  
  ```bash
  php artisan db:seed --class=PurchaseOrder\Database\Seeders\PurchaseOrderSeeder
  ```

- **Use Eloquent models**  
  ```php
  use PurchaseOrder\Models\Product;

  $products = Product::with(['brand', 'category', 'images'])->get();
  ```

- **Use API Resources in your controllers**  
  ```php
  use PurchaseOrder\Http\Resources\ProductResource;

  public function show($id)
  {
      $product = Product::with(['brand', 'category', 'images'])->findOrFail($id);
      return new ProductResource($product);
  }
  ```

---

## Publishing & Customization

You can publish migrations, language files, and models for customization:

- Migrations:  
  ```bash
  php artisan vendor:publish --tag=purchaseorder-migrations
  ```
- Translations:  
  ```bash
  php artisan vendor:publish --tag=purchaseorder-lang
  ```
- Models:  
  ```bash
  php artisan vendor:publish --tag=purchaseorder-models
  ```
  (Copies to `app/Models/PurchaseOrder/`)

---

## API Resources

All resource classes are in `src/Http/Resources/`:

- `ProductResource`
- `CategoryResource`
- `BrandResource`
- `ProductImageResource`
- `OrderResource`
- `OrderItemResource`
- `PaymentResource`

Use these in your controllers for formatted JSON responses.

---

## Seeding Data

Sample data can be generated using factories and the provided seeder.  
Make sure to run migrations before seeding.

```bash
php artisan migrate:fresh
php artisan db:seed --class=PurchaseOrder\Database\Seeders\PurchaseOrderSeeder
```

---

## Contributing

Contributions are welcome! Fork the repo, make your changes, and submit a pull request.

---

## License

This package is open-source and distributed under the MIT license.
