<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PurchaseOrder\ProductDetail;

class ProductDetailSeeder extends Seeder
{
    public function run()
    {
        ProductDetail::factory()->count(20)->create();
    }
}
