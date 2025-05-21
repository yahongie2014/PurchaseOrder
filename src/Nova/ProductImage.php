<?php

namespace App\Nova\PurchaseOrder;

use Laravel\Nova\Fields\Select;
use Laravel\Nova\Resource;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;

class ProductImage extends Resource
{

    public static $model = \PurchaseOrder\Models\ProductImage::class;

    public static $title = 'url';

    public static $search = ['id', 'url'];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('Product'),

            Select::make('Type')
                ->options([
                    'url' => 'URL',
                    'image' => 'Image',
                ])
                ->displayUsingLabels()
                ->rules('required'),

            Number::make('Position')->nullable(),

            Text::make('Type')->nullable(),
        ];
    }
}
