<?php

namespace App\Nova\PurchaseOrder;

use Laravel\Nova\Fields\Select;
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
        $locales = config('locales.locales', ['en' => 'English', 'ar' => 'Arabic']);

        return [
            ID::make()->sortable(),
            BelongsTo::make('Category'),
            Select::make('Locale')
                ->options($locales)
                ->rules('required', 'max:10')
                ->displayUsingLabels(),
            Text::make('Name')->rules('required', 'max:255'),
            Text::make('Description')->hideFromIndex(),
        ];
    }
}
