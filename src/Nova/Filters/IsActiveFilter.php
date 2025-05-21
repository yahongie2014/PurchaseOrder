<?php

namespace PurchaseOrder\Nova\Filters;

use Illuminate\Http\Request;
use Laravel\Nova\Filters\BooleanFilter;

class IsActiveFilter extends BooleanFilter
{
    public $name = 'Active Status';

    public function apply(Request $request, $query, $value)
    {
        if (isset($value['Active']) && $value['Active']) {
            return $query->where('is_active', true);
        }
        return $query;
    }

    public function options(Request $request)
    {
        return [
            'Active' => 'Active',
        ];
    }
}
