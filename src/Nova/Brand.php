<?php

namespace App\Nova;

use App\Nova\Repeaters\LanguageRepeate;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Repeater;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Resource;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Http\Requests\NovaRequest;

class Brand extends Resource
{
    public static $model = \App\Models\PurchaseOrder\Brand::class;

    public static $title = 'name';

    public static $search = ['name', 'slug'];

    public static function label()
    {
        return __('Brands');
    }

    public static function singularLabel()
    {
        return __('Brands');
    }

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            Text::make(__('Name'), 'name'),
            Slug::make(__('Slug'), 'slug')
                ->from('name')
                ->separator('-')
                ->creationRules('required', 'max:100')
                ->updateRules('nullable', 'max:100')
                ->sortable(),
            Text::make(__('Translation'), 'translation')
                ->translatable()
                ->rules('required', 'min:2')
                ->sortable(),
            Image::make('Logo')
                ->disk('public')
                ->path('brands')
                ->creationRules('required', 'image', 'max:2048')
                ->updateRules('nullable', 'image', 'max:2048'),
            Boolean::make('Is Active')
        ];
    }
}
