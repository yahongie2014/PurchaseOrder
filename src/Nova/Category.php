<?php

namespace App\Nova\PurchaseOrder;

use Laravel\Nova\Resource;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\HasMany;
use MrMonat\Translatable\Translatable;
use Whitecube\NovaFlexibleContent\Flexible;
use Laravel\Nova\Fields\Textarea;
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
            Text::make('Slug')
                ->sortable()
                ->rules('required', 'max:255')
                ->creationRules('unique:categories,slug')
                ->fillUsing(function ($request, $model, $attribute, $requestAttribute) {
                    if ($request->input($requestAttribute)) {
                        $model->{$attribute} = $request->input($requestAttribute);
                    } else {
                        $model->{$attribute} = 'CAT-' . strtoupper(Str::random(8));
                    }
                }),
            Boolean::make('Is Active'),
            HasMany::make('Details', 'details', CategoryDetail::class)->hideWhenCreating()->hideWhenUpdating(),
            HasMany::make('Products', 'products', Product::class),
        ];
    }
}
