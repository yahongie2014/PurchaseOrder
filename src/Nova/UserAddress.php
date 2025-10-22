<?php

namespace App\Nova;

use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Resource;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;

class UserAddress extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\PurchaseOrder\UserAddress::class;

    /**
     * The single value that should be used to represent the resource.
     *
     * @var string
     */
    public static $title = 'address_line_1';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'address_line_1',
        'city',
        'postal_code',
        'country',
        'phone',          // Add phone to searchable columns if needed
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @return array
     */
    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            BelongsTo::make('User'),

            Text::make('Address Line 1')
                ->rules('required', 'max:255'),

            Text::make('Address Line 2')
                ->nullable()
                ->rules('max:255'),

            Text::make('City')
                ->rules('required', 'max:100'),

            Text::make('State')
                ->nullable()
                ->rules('max:100'),

            Text::make('Postal Code')
                ->nullable()
                ->rules('max:20'),

            Text::make('Country')
                ->rules('required', 'max:100'),

            Number::make('Phone')
                ->nullable()
                ->rules('max:20'),

            DateTime::make('Available', 'available_in')->sortable(),
        ];
    }
}
