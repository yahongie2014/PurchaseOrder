<?php

namespace App\Nova\PurchaseOrder;

use Laravel\Nova\Resource;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Http\Requests\NovaRequest;

class Brand extends Resource
{
    public static $model = \App\Models\PurchaseOrder\Brand::class;

    public static $title = 'slug';

    public static $search = ['id', 'slug'];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            Text::make('Slug')
                ->sortable()
                ->rules('required', 'max:255')
                ->creationRules('unique:brands,slug')
                ->fillUsing(function ($request, $model, $attribute, $requestAttribute) {
                    if ($request->input($requestAttribute)) {
                        $model->{$attribute} = $request->input($requestAttribute);
                    } else {
                        $model->{$attribute} = 'BRD-' . strtoupper(Str::random(8));
                    }
                }),
            Text::make('Logo')->nullable(),
            Boolean::make('Is Active'),
            HasMany::make('Products', 'products', Product::class),
            HasMany::make('Details', 'details', BrandDetail::class)->hideWhenCreating()->hideWhenUpdating(),

        ];
    }
}
