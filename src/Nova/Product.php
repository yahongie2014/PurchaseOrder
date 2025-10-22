<?php

namespace App\Nova;

use Laravel\Nova\Fields\Image;
use App\Nova\Actions\ToggleActiveStatus;
use App\Nova\Filters\IsActiveFilter;
use App\Nova\Repeaters\LanguageRepeate;
use Laravel\Nova\Fields\Repeater;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Resource;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Http\Requests\NovaRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Nova\Panel;
use Laravel\Nova\Fields\Trix;

class Product extends Resource
{
    public static $model = \App\Models\PurchaseOrder\Product::class;

    public static $title = 'sku';

    public static $search = ['id', 'sku', 'barcode'];

    public function fields(NovaRequest $request)
    {

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
            Text::make('Name', function () {
                return $this->name ?? $this->getNameAttribute();
            })->onlyOnIndex(),
            Repeater::make('Translation')
                ->repeatables([
                    LanguageRepeate::make(),
                ])->showOnDetail(),
            Panel::make('Pricing', [
                Number::make('Original Price')->step(0.01)->hideFromIndex(),
                Number::make('Cost Price')->step(0.01)->hideFromIndex(),
                Number::make('Sale Price')->step(0.01),
                Boolean::make('Is Sale'),
            ]),

            Panel::make('Inventory', [
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
            ]),

            Image::make('Cover Image', 'cover_img_url')
                ->disk('public')
                ->path('product_covers')
                ->creationRules('required', 'image', 'max:2048')
                ->updateRules('nullable', 'image', 'max:2048')
                ->thumbnail(function () {
                    return $this->cover_img_url ? $this->cover_img_url : null;
                })->preview(function () {
                    return $this->cover_img_url ? $this->cover_img_url : null;
                }),

            Trix::make('Description')->alwaysShow()->nullable(),

            Panel::make('Dimensions', [
                Number::make('Weight')->step(0.01),
                Number::make('Length')->step(0.01),
                Number::make('Width')->step(0.01),
                Number::make('Height')->step(0.01),
            ]),

            BelongsTo::make('Brand'),
            BelongsTo::make('Category'),
            HasMany::make('Images', 'images', ProductImage::class),
            HasMany::make('Order Items', 'orderItems', OrderItem::class),
            Boolean::make('Is Active'),
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
