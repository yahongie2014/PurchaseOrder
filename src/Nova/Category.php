<?php

namespace App\Nova;

use App\Nova\Repeaters\LanguageRepeate;
use Laravel\Nova\Fields\Repeater;
use Laravel\Nova\Resource;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Image;
use Laravel\Nova\Http\Requests\NovaRequest;
use Illuminate\Support\Str;

class Category extends Resource
{
    public static $model = \App\Models\PurchaseOrder\Category::class;

    public static $title = 'slug';

    public static $search = ['id', 'slug'];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Image::make('Cover Image', 'cover_img')
                ->disk('public')
                ->path('categories')
                ->creationRules('required', 'image', 'max:2048')
                ->updateRules('nullable', 'image', 'max:2048'),

            Repeater::make('Translation')
                ->repeatables([
                    LanguageRepeate::make(),
                ])->showOnDetail(),
            Text::make('Slug')
                ->sortable()
                ->rules('required', 'max:255')
                ->creationRules('unique:categories,slug')
                ->fillUsing(function ($request, $model, $attribute, $requestAttribute) {
                    if ($request->input($requestAttribute)) {
                        $model->{$attribute} = $request->input($requestAttribute);
                    } elseif ($request->isCreateOrAttachRequest()) {
                        $model->{$attribute} = 'CAT-' . strtoupper(Str::random(8));
                    }
                }),

            Boolean::make('Is Active'),
        ];
    }
}
