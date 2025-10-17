<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PurchaseOrder\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::factory()->count(20)->create();
    }
}
