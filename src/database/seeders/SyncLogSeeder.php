<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PurchaseOrder\SyncLog;

class SyncLogSeeder extends Seeder
{
    public function run()
    {
        SyncLog::factory()->count(30)->create();
    }
}
