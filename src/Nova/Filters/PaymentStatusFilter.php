<?php

namespace PurchaseOrder\Nova\Filters;

use Illuminate\Http\Request;
use Laravel\Nova\Filters\SelectFilter;

class PaymentStatusFilter extends SelectFilter
{
    public $name = 'Payment Status';

    public function apply(Request $request, $query, $value)
    {
        return $query->where('payment_status', $value);
    }

    public function options(Request $request)
    {
        return [
            'Paid' => 'paid',
            'Pending' => 'pending',
            'Failed' => 'failed',
            'Cancelled' => 'cancelled',
        ];
    }
}
