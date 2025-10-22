<?php

namespace App\Nova\Metrics;

use App\Models\PurchaseOrder\Order;
use DateTimeInterface;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;
use Laravel\Nova\Metrics\PartitionResult;

class PaymentStatusPartition extends Partition
{

    public function calculate(NovaRequest $request): PartitionResult
    {
        return $this->count($request, Order::class, 'payment_status');
    }

    public function cacheFor(): DateTimeInterface|null
    {
        return now()->addMinutes(10);
    }

    public function uriKey(): string
    {
        return 'payment-status-partition';
    }
}
