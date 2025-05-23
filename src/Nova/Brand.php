<?php

namespace App\Nova\PurchaseOrder;

use App\Nova\Repeaters\LanguageRepeate;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Repeater;
use Laravel\Nova\Resource;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Http\Requests\NovaRequest;

class Brand extends Resource
{
    public static $model = \App\Models\PurchaseOrder\Brand::class;

    public static $title = 'name';

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
                })
                ->creationRules('required', 'max:100')
                ->updateRules('nullable', 'max:100'),
            Repeater::make('Translation')
                ->repeatables([
                    LanguageRepeate::make(),
                ])->showOnDetail(),
            Image::make('Logo')
                ->disk('public')
                ->path('brands')
                ->creationRules('required', 'image', 'max:2048')
                ->updateRules('nullable', 'image', 'max:2048'),
            Boolean::make('Is Active')
        ];
    }
}
