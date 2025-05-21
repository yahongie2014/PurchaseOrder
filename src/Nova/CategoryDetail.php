<?php

namespace PurchaseOrder\Nova;

use Laravel\Nova\Resource;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;

class CategoryDetail extends Resource
{
    public static $model = \PurchaseOrder\Models\CategoryDetail::class;

    public static $title = 'name';

    public static $search = ['id', 'name'];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('Category'),

            Text::make('Locale')->rules('required', 'max:10'),

            Text::make('Name')->rules('required', 'max:255'),

            Text::make('Description')->hideFromIndex(),
        ];
    }
}
