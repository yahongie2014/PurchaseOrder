<?php

namespace App\Nova;

use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Image;
use App\Nova\Actions\ToggleActiveStatus;
use App\Nova\Filters\IsActiveFilter;
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
use Laravel\Nova\Fields\Badge;
use Outl1ne\NovaTranslatable\HandlesTranslatable;

class Product extends Resource
{
    use HandlesTranslatable;

    public static string $model = \App\Models\PurchaseOrder\Product::class;
    public static $title = 'name';
    public static $search = ['name', 'slug', 'barcode'];

    public static function getTranslatableLocales(): array
    {
        return [
            'en' => 'English',
            'ar' => 'Arabic',
        ];
    }

    public function fields(NovaRequest $request)
    {

        return [
            ID::make()->sortable(),
            Text::make(__('SKU'), 'sku')
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
            new Panel(__('Details & Translations'), [
                Text::make(__('Name'), 'name')
                    ->translatable()
                    ->rules('required', 'string', 'max:255'),
                Trix::make(__('Description'), 'description')
                    ->translatable()
                    ->rules('nullable', 'string'),
            ]),

            Panel::make('Pricing', [
                Number::make(__('Original Price'), 'original_price')->step(0.01)->hideFromIndex(),
                Number::make(__('Cost Price'), 'cost_price')->step(0.01)->hideFromIndex(),
                Boolean::make(__('Have Sale'), 'is_sale')->hideFromIndex(),
                Number::make(__('Sale Price'), 'sale_price')
                    ->step(0.01)
                    ->dependsOn('is_sale', function ($field, $request, $formData) {
                        if ($formData->is_sale) {
                            $field->show()->rules('required', 'numeric', 'min:0');
                        } else {
                            $field->hide();
                        }
                    }),
            ]),

            Panel::make(__('Inventory'), [
                Number::make(__('Stock Quantity'), 'stock_quantity'),

                Boolean::make(__('Have Tax Rate'), 'is_taxable')->hideFromIndex(),
                Number::make(__('Tax Rate'), 'tax_rate')
                    ->step(0.01)
                    ->dependsOn('is_taxable', function ($field, $request, $formData) {
                        if ($formData->is_sale) {
                            $field->show()->rules('required', 'numeric', 'min:0');
                        } else {
                            $field->hide();
                        }
                    }),
                Select::make(__('Unit'), 'unit')
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

            Image::make(__('Cover Image'), 'cover_img')
                ->disk('public')
                ->path('product_covers')
                ->creationRules('required', 'image', 'max:2048')
                ->updateRules('nullable', 'image', 'max:2048')
                ->thumbnail(function () {
                    return $this->cover_img_url ? $this->cover_img_url : null;
                })->preview(function () {
                    return $this->cover_img_url ? $this->cover_img_url : null;
                }),

            Panel::make(__('Dimensions'), [
                Number::make(__('Weight'), 'weight')->step(0.01),
                Number::make(__('Length'), 'length')->step(0.01),
                Number::make(__('Width'), 'width')->step(0.01),
                Number::make(__('Height'), 'height')->step(0.01),
            ]),

            BelongsTo::make(__('Brand'), 'brand', Brand::class),
            BelongsToMany::make(__('Category'), 'categories', \App\Nova\Category::class),
            HasMany::make(__('Images'), 'images', ProductImage::class),
            HasMany::make(__('Order Items'), 'orderItems', OrderItem::class),
            Badge::make(__('Status'), 'is_active')
                ->map([
                    1 => 'success',
                    0 => 'danger',
                ])
                ->labels([
                    1 => __('Active'),
                    0 => __('Inactive'),
                ])
                ->sortable(),
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
