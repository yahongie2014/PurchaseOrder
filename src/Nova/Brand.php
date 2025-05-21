<?php

namespace PurchaseOrder\Nova;

use Laravel\Nova\Resource;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Http\Requests\NovaRequest;

class Brand extends Resource
{
    public static $model = \PurchaseOrder\Models\Brand::class;

    public static $title = 'slug';

    public static $search = ['id', 'slug'];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Slug')->sortable()->rules('required', 'max:255'),

            Text::make('Logo')->nullable(),

            Boolean::make('Is Active'),

            HasMany::make('Details', 'details', BrandDetail::class),

            HasMany::make('Products', 'products', Product::class),
        ];
    }
}
