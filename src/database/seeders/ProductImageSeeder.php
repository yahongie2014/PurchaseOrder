<?php

namespace PurchaseOrder\Database\Seeders;

use Illuminate\Database\Seeder;
use PurchaseOrder\Models\ProductImage;

class ProductImageSeeder extends Seeder
{
    public function run()
    {
        ProductImage::factory()->count(150)->create();
    }
}
