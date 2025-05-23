<?php

namespace App\Nova\PurchaseOrder\Metrics;

use App\Models\PurchaseOrder\Order;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Trend;
use Laravel\Nova\Metrics\TrendResult;

class OrdersPerDay extends Trend
{
    public function calculate(NovaRequest $request): TrendResult
    {
        return $this->countByDays($request, Order::class, 'created_at');
    }

    public function ranges(): array
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
