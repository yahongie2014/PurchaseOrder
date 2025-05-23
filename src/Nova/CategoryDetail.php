<?php

namespace App\Nova\PurchaseOrder;

use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Resource;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;

class CategoryDetail extends Resource
{
    public static $model = \App\Models\PurchaseOrder\CategoryDetail::class;

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
                ->creationRules('required', 'max:100')
                ->updateRules('nullable', 'max:100')
                ->displayUsingLabels(),
            Text::make('Name')
                ->creationRules('required', 'max:255')
                ->updateRules('required', 'max:255'),
            Trix::make('Description')
                ->creationRules('required', 'max:500')
                ->updateRules('required', 'max:500')
                ->hideFromIndex(),
        ];
    }
}
