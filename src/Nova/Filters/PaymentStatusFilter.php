<?php

namespace App\Nova\PurchaseOrder\Filters;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Laravel\Nova\Filters\Filter;
use Laravel\Nova\Http\Requests\NovaRequest;

class PaymentStatusFilter extends Filter
{
    public $name = 'Payment Status';

    public function apply(NovaRequest $request, Builder $query, mixed $value): Builder
    {
        return $query->where('payment_status', $value);
    }

    public function options(NovaRequest $request): array
    {
        return [
            'Paid' => 'paid',
            'Pending' => 'pending',
            'Rejected' => 'rejected',
            'Partial' => 'partial',
        ];
    }
}
