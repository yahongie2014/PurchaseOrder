<?php

namespace PurchaseOrder\Nova;

use Laravel\Nova\Resource;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;

class OrderItem extends Resource
{
    public static $model = \PurchaseOrder\Models\OrderItem::class;

    public static $title = 'product_name';

    public static $search = ['id', 'product_name'];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('Order'),

            BelongsTo::make('Product'),

            Text::make('Product Name')->sortable()->rules('required', 'max:255'),

            Number::make('Quantity', 'qty'),

            Number::make('Unit Price')->step(0.01),

            Number::make('Discount Amount')->step(0.01),

            Number::make('Tax Amount')->step(0.01),

            Number::make('Total Price')->step(0.01),
        ];
    }
}
