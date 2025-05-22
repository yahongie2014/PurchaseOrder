<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PurchaseOrder\OrderItem;

class OrderItemSeeder extends Seeder
{
    public function run()
    {
        OrderItem::factory()->count(20)->create();
    }
}
