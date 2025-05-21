<?php

namespace PurchaseOrder\Database\Seeders;

use Illuminate\Database\Seeder;
use PurchaseOrder\Models\CategoryDetail;

class CategoryDetailSeeder extends Seeder
{
    public function run()
    {
        CategoryDetail::factory()->count(15)->create();
    }
}
