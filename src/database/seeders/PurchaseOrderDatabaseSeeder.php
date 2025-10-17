<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PurchaseOrderDatabaseSeeder extends Seeder
{
    public function run()
    {
        $this->call([
            BrandSeeder::class,
            CashierSeeder::class,
            CategorySeeder::class,
            CurrencyRateSeeder::class,
            CustomerSeeder::class,
            OrderSeeder::class,
            OrderItemSeeder::class,
            PaymentSeeder::class,
            ProductImageSeeder::class,
            SyncLogSeeder::class,
            LanguagesSeeder::class,
        ]);
    }
}
