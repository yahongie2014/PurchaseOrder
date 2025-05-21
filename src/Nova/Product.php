<?php

namespace App\Nova\PurchaseOrder;

use App\Nova\PurchaseOrder\Actions\ToggleActiveStatus;
use App\Nova\PurchaseOrder\Filters\IsActiveFilter;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Panel;
use Laravel\Nova\Resource;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Http\Requests\NovaRequest;
use Illuminate\Http\Request;

class Product extends Resource
{
    public static $model = \PurchaseOrder\Models\Product::class;

    public static $title = 'sku';

    public static $search = ['id', 'sku', 'barcode'];

    public function fields(NovaRequest $request)
    {
        $locales = config('app.locales', ['en', 'ar']);

        return [
            ID::make()->sortable(),
            Text::make('SKU')
                ->sortable()
                ->rules('required', 'max:255')
                ->creationRules('unique:products,sku')
                ->fillUsing(function ($request, $model, $attribute, $requestAttribute) {
                    if ($request->input($requestAttribute)) {
                        $model->{$attribute} = $request->input($requestAttribute);
                    } else {
                        $model->{$attribute} = 'PROD-' . strtoupper(Str::random(8));
                    }
                }),
            Text::make('Barcode')->nullable(),
            Number::make('Original Price')->step(0.01),
            Number::make('Cost Price')->step(0.01),
            Number::make('Sale Price')->step(0.01),
            Boolean::make('Is Sale'),
            Number::make('Stock Quantity'),
            Number::make('Tax Rate')->step(0.01),
            Boolean::make('Is Taxable'),
            Select::make('Unit')
                ->options([
                    'pcs' => 'Pieces',
                    'kg' => 'Kilograms',
                    'ltr' => 'Liters',
                    'm' => 'Meters',
                    'cm' => 'Centimeters',
                ])
                ->nullable()
                ->displayUsingLabels(),
            Number::make('Weight')->step(0.01),
            Number::make('Length')->step(0.01),
            Number::make('Width')->step(0.01),
            Number::make('Height')->step(0.01),
            BelongsTo::make('Brand'),
            BelongsTo::make('Category'),
            HasMany::make('Images', 'images', ProductImage::class),
            HasMany::make('Order Items', 'orderItems', OrderItem::class),
            Boolean::make('Is Active'),
            HasMany::make('Details', 'details', ProductDetail::class)->hideWhenCreating()->hideWhenUpdating(),
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
