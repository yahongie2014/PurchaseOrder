<?php

namespace PurchaseOrder\Nova;

use Laravel\Nova\Resource;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Http\Requests\NovaRequest;

class Payment extends Resource
{
    public static $model = \PurchaseOrder\Models\Payment::class;

    public static $title = 'method';

    public static $search = ['id', 'method', 'reference'];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('Order'),

            Text::make('Method')->sortable()->rules('required', 'max:255'),

            Number::make('Amount')->step(0.01),

            Text::make('Reference')->nullable(),

            DateTime::make('Paid At')->nullable(),
        ];
    }
}
