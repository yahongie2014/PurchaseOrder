<?php

namespace App\Nova;

use Laravel\Nova\Resource;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Slug;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;
use Outl1ne\NovaTranslatable\HandlesTranslatable;

class Category extends Resource
{
    use HandlesTranslatable;

    public static $model = \App\Models\PurchaseOrder\Category::class;

    public static $title = 'name';


    public static $search = [
        'slug',
        'name',
    ];

    public static function label()
    {
        return __('Categories');
    }

    public static function singularLabel()
    {
        return __('Category');
    }

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            Text::make(__('Name'), 'name'),
            Text::make(__('Translation'), 'translation')
                ->translatable()
                ->rules('required', 'min:2')
                ->sortable(),
            Slug::make(__('Slug'), 'slug')
                ->from('name')
                ->separator('-')
                ->rules('required')
                ->sortable(),

            BelongsTo::make(__('Parent'), 'parent', self::class)->nullable(),

            Boolean::make(__('Active'), 'is_active'),
        ];
    }

    public function filters(NovaRequest $request)
    {
        return [
            new \App\Nova\Filters\IsActiveFilter(),
        ];
    }

    public function actions(NovaRequest $request)
    {
        return [];
    }
}
