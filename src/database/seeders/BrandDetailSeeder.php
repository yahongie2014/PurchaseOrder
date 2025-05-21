<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use PurchaseOrder\Models\BrandDetail;

class BrandDetailSeeder extends Seeder
{
    public function run()
    {
        BrandDetail::factory()->count(20)->create();
    }
}
