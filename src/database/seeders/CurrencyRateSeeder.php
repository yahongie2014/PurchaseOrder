<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use PurchaseOrder\Models\CurrencyRate;

class CurrencyRateSeeder extends Seeder
{
    public function run()
    {
        CurrencyRate::factory()->count(5)->create();
    }
}
