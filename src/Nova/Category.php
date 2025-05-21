<?php

namespace PurchaseOrder\Nova;

use Laravel\Nova\Resource;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Whitecube\NovaFlexibleContent\Flexible;
use OptimistDigital\NovaTranslatable\Translatable;
use Laravel\Nova\Http\Requests\NovaRequest;

class Category extends Resource
{
    public static $model = \PurchaseOrder\Models\Category::class;

    public static $title = 'slug';

    public static $search = ['id', 'slug'];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Translatable::make([
                Text::make('Name')->rules('required'),
                Textarea::make('Description'),
            ]),
            Text::make('Slug')->sortable()->rules('required', 'max:255'),

            Boolean::make('Is Active'),

            HasMany::make('Details', 'details', CategoryDetail::class),

            HasMany::make('Products', 'products', Product::class),
        ];
    }
}
