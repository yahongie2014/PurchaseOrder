<?php

namespace PurchaseOrder\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;

class InstallPurchaseOrder extends Command
{
    protected $signature = 'purchaseorder:install';
    protected $description = 'Publish PurchaseOrder package assets and required dependencies (Sanctum)';

    public function handle()
    {
        $this->info('Publishing PurchaseOrder assets...');
        Artisan::call('vendor:publish', ['--tag' => 'pos-all']);
        $this->info(trim(Artisan::output()));

        $this->info('Publishing PurchaseOrder Nova resources... (pos-nova)');
        Artisan::call('vendor:publish', ['--tag' => 'pos-nova']);
        $this->info(trim(Artisan::output()));

        $this->info('Publishing Laravel Sanctum assets (if installed)...');
        try {
            Artisan::call('vendor:publish', ['--provider' => 'Laravel\Sanctum\SanctumServiceProvider']);
            $this->info(trim(Artisan::output()));
        } catch (\Exception $e) {
            $this->warn('Sanctum not installed or publish failed: ' . $e->getMessage());
        }

        $this->info('Make sure to run migrations: php artisan migrate');

        return 0;
    }
}
