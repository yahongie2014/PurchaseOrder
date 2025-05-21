<?php

namespace PurchaseOrder\Database\Seeders;

use Illuminate\Database\Seeder;
use PurchaseOrder\Models\Brand;

class BrandSeeder extends Seeder
{
    public function run()
    {
        Brand::factory()->count(20)->create();
    }
}
