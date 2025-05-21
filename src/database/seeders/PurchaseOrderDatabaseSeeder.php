<?php

namespace PurchaseOrder\Database\Seeders;

use Illuminate\Database\Seeder;

class PurchaseOrderDatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            BrandSeeder::class,
            BrandDetailSeeder::class,
            CashierSeeder::class,
            CategorySeeder::class,
            CategoryDetailSeeder::class,
            CurrencyRateSeeder::class,
            CustomerSeeder::class,
            OrderSeeder::class,
            OrderItemSeeder::class,
            PaymentSeeder::class,
            ProductDetailSeeder::class,
            ProductImageSeeder::class,
            SyncLogSeeder::class,
        ]);
    }
}
