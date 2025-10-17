<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PurchaseOrder\ProductImage;

class ProductImageSeeder extends Seeder
{
    public function run()
    {
        ProductImage::factory()->count(20)->create();
    }
}
