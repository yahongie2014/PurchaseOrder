<?php

namespace PurchaseOrder\Nova\Metrics;

use Laravel\Nova\Metrics\Trend;
use Illuminate\Http\Request;
use PurchaseOrder\Models\Order;

class OrdersPerDay extends Trend
{
    public function calculate(Request $request)
    {
        return $this->countByDays($request, Order::class);
    }

    public function ranges()
    {
        return [
            7 => 'Last 7 Days',
            30 => 'Last 30 Days',
            60 => 'Last 60 Days',
        ];
    }

    public function cacheFor()
    {
        return now()->addMinutes(5);
    }

    public function uriKey()
    {
        return 'orders-per-day';
    }
}
