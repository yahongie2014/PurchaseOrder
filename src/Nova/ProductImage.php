<?php

namespace App\Nova\PurchaseOrder;

use Epartment\NovaDependencyContainer\HasDependencies;
use Epartment\NovaDependencyContainer\NovaDependencyContainer;
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
    use HasDependencies;

    public static $model = \PurchaseOrder\Models\ProductImage::class;

    public static $title = 'url';

    public static $search = ['id', 'url'];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('Product'),

            Select::make('Type')
                ->options([
                    'url' => 'URL',
                    'image' => 'Image',
                ])
                ->displayUsingLabels()
                ->rules('required'),

            NovaDependencyContainer::make([
                Text::make('URL')
                    ->rules('required', 'max:255'),
            ])->dependsOn('type', 'url'),

            NovaDependencyContainer::make([
                Image::make('Image')
                    ->disk('public'),
            ])->dependsOn('type', 'image'),

            Number::make('Position')->nullable(),

            Text::make('Type')->nullable(),
        ];
    }
}
