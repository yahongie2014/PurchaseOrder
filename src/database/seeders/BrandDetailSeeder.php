<?php

namespace Database\Seeders;

use App\Models\PurchaseOrder\BrandDetail;
use Illuminate\Database\Seeder;

class BrandDetailSeeder extends Seeder
{
    public function run()
    {
        BrandDetail::factory()->count(20)->create();
    }
}
