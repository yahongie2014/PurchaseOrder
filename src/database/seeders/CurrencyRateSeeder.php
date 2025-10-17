<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PurchaseOrder\CurrencyRate;

class CurrencyRateSeeder extends Seeder
{
    public function run()
    {
        CurrencyRate::factory()->count(5)->create();
    }
}
