<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PurchaseOrder\Cashier;

class CashierSeeder extends Seeder
{
    public function run()
    {
        Cashier::factory()->count(10)->create();
    }
}
