<?php

namespace PurchaseOrder\Nova\Metrics;

use Laravel\Nova\Metrics\Partition;
use Illuminate\Http\Request;
use PurchaseOrder\Models\Order;

class PaymentStatusPartition extends Partition
{
    public function calculate(Request $request)
    {
        return $this->count($request, Order::class, 'payment_status');
    }

    public function cacheFor()
    {
        return now()->addMinutes(10);
    }

    public function uriKey()
    {
        return 'payment-status-partition';
    }
}
