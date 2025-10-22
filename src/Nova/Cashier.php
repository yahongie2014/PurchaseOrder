<?php

namespace App\Nova;

use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Resource;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Http\Requests\NovaRequest;

class Cashier extends Resource
{
    public static $model = \App\Models\PurchaseOrder\Cashier::class;

    public static $title = 'name';

    public static $search = ['id', 'name'];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Name')->sortable()->rules('required', 'max:255'),
            BelongsTo::make('User', 'user', \App\Nova\User::class)->searchable(),
            HasMany::make('Orders', 'orders', Order::class),
        ];
    }
}
