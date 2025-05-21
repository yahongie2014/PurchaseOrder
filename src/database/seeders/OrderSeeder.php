<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use PurchaseOrder\Models\Order;

class OrderSeeder extends Seeder
{
    public function run()
    {
        Order::factory()->count(20)->create();
    }
}
