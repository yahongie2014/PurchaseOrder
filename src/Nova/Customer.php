<?php

namespace App\Nova\PurchaseOrder;

use Laravel\Nova\Resource;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Http\Requests\NovaRequest;

class Customer extends Resource
{
    public static $model = \App\Models\PurchaseOrder\Customer::class;

    public static $title = 'name';

    public static $search = ['id', 'name', 'phone', 'email'];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Name')->sortable()->rules('required', 'max:255'),

            Text::make('Phone')->rules('required', 'max:20'),

            Text::make('Email')->rules('email', 'max:255')->nullable(),

            HasMany::make('Orders', 'orders', Order::class),
        ];
    }
}
