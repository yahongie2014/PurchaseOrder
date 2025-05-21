<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use PurchaseOrder\Models\Cashier;

class CashierSeeder extends Seeder
{
    public function run()
    {
        Cashier::factory()->count(10)->create();
    }
}
