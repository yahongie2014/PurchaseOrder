<?php

namespace App\Nova\PurchaseOrder;

use Laravel\Nova\Fields\Image;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Resource;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;

class ProductImage extends Resource
{

    public static $model = \App\Models\PurchaseOrder\ProductImage::class;

    public static $title = 'url';

    public static $search = ['id', 'url'];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            BelongsTo::make('Product'),
            Image::make('Image', 'url')
                ->disk('public')
                ->path('product_images')
                ->creationRules('required', 'image', 'max:2048')
                ->updateRules('nullable', 'image', 'max:2048'),
            Select::make('Type')
                ->options(['thumbnail' => 'Thumbnail', 'gallery' => 'Gallery', 'icon' => 'Icon'])
                ->creationRules('required')
                ->updateRules('nullable')
                ->displayUsingLabels(),

        ];
    }
}
