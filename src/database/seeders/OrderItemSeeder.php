<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use PurchaseOrder\Models\OrderItem;

class OrderItemSeeder extends Seeder
{
    public function run()
    {
        OrderItem::factory()->count(100)->create();
    }
}
