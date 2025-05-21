<?php

namespace App\Nova\Filters;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Laravel\Nova\Filters\Filter;
use Laravel\Nova\Http\Requests\NovaRequest;

class IsActiveFilter extends Filter
{
    public $name = 'Active Status';

    public function apply(NovaRequest $request, Builder $query, mixed $value): Builder
    {
        if (isset($value['Active']) && $value['Active']) {
            return $query->where('is_active', true);
        } elseif (isset($value['Active']) && !$value['Active']) {
            return $query->where('is_active', false);
        }

        return $query;
    }

    public function options(NovaRequest $request): array
    {
        return [
            'Active' => 'Active',
        ];
    }
}
