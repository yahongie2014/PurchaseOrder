<?php

namespace App\Nova\PurchaseOrder;

use App\Nova\PurchaseOrder\Actions\ToggleActiveStatus;
use App\Nova\PurchaseOrder\Filters\IsActiveFilter;
use Laravel\Nova\Resource;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Http\Requests\NovaRequest;
use Illuminate\Http\Request;
use MrMonat\Translatable\Translatable;

class Product extends Resource
{
    public static $model = \PurchaseOrder\Models\Product::class;

    public static $title = 'sku';

    public static $search = ['id', 'sku', 'barcode', 'name->en', 'name->ar',];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),
            Translatable::make('Name')->singleLine()->rules('required'),
            Translatable::make('Description')->singleLine()->rules('required'),
            Text::make('SKU')->sortable()->rules('required', 'max:255'),
            Text::make('Barcode')->nullable(),
            Number::make('Original Price')->step(0.01),
            Number::make('Cost Price')->step(0.01),
            Number::make('Sale Price')->step(0.01),
            Boolean::make('Is Sale'),
            Number::make('Stock Quantity'),
            Number::make('Tax Rate')->step(0.01),
            Boolean::make('Is Taxable'),
            Text::make('Unit')->nullable(),
            Number::make('Weight')->step(0.01),
            Number::make('Length')->step(0.01),
            Number::make('Width')->step(0.01),
            Number::make('Height')->step(0.01),
            BelongsTo::make('Brand'),
            BelongsTo::make('Category'),
            HasMany::make('Images', 'images', ProductImage::class),
            HasMany::make('Order Items', 'orderItems', OrderItem::class),
            Boolean::make('Is Active'),
            Text::make('Description')->hideFromIndex(),
        ];
    }

    public function filters(Request $request)
    {
        return [
            new IsActiveFilter(),
        ];
    }

    public function actions(Request $request)
    {
        return [
            new ToggleActiveStatus(),
        ];
    }
}
