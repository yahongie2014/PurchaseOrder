<?php

namespace App\Nova;

use Laravel\Nova\Resource;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;

class OrderItem extends Resource
{
    public static $model = \App\Models\PurchaseOrder\OrderItem::class;

    public static $title = 'Product';

    public static $search = ['id', 'product_id'];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            BelongsTo::make('Order', 'order', Order::class)->nullable(),
            BelongsTo::make('Product', 'product', Product::class)->nullable(),
            Number::make('Quantity', 'qty'),
            Number::make('Unit Price')->step(0.01),
            Number::make('Discount Amount')->step(0.01),
            Number::make('Tax Amount')->step(0.01),
            Number::make('Total Price')->step(0.01),
        ];
    }
}
