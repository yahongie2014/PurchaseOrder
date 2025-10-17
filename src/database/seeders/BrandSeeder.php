<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PurchaseOrder\Brand;

class BrandSeeder extends Seeder
{
    public function run()
    {
        Brand::factory()->count(20)->create();
    }
}
