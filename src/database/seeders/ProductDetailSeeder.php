<?php

namespace PurchaseOrder\Database\Seeders;

use Illuminate\Database\Seeder;
use PurchaseOrder\Models\ProductDetail;

class ProductDetailSeeder extends Seeder
{
    public function run()
    {
        ProductDetail::factory()->count(50)->create();
    }
}
