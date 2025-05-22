<?php

namespace App\Nova\PurchaseOrder;

use Laravel\Nova\Resource;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Http\Requests\NovaRequest;

class CurrencyRate extends Resource
{
    public static $model = \App\Models\PurchaseOrder\CurrencyRate::class;

    public static $title = 'currency_code';

    public static $search = ['id', 'currency_code'];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            Text::make('Currency Code')->sortable()->rules('required', 'max:3'),
            Number::make('Rate')->step(0.000001),
        ];
    }
}
