<?php

namespace PurchaseOrder\Database\Seeders;

use Illuminate\Database\Seeder;
use PurchaseOrder\Models\SyncLog;

class SyncLogSeeder extends Seeder
{
    public function run()
    {
        SyncLog::factory()->count(30)->create();
    }
}
