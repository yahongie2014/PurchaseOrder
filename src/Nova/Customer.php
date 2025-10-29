<?php

namespace App\Nova;

use Laravel\Nova\Auth\PasswordValidationRules;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Resource;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Http\Requests\NovaRequest;

class Customer extends Resource
{
    use PasswordValidationRules;

    public static $model = \App\Models\PurchaseOrder\Customer::class;

    public static $title = 'name';

    public static $search = ['id', 'name', 'phone', 'email'];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Text::make(__('Name'), 'name')->sortable()->rules('required', 'max:255'),

            Text::make(__('Phone'), 'phone')->rules('required', 'max:20'),

            Text::make(__('Email'), 'email')->rules('email', 'max:255')->nullable(),
            Password::make(__('Password'), 'password')
                ->onlyOnForms()
                ->creationRules($this->passwordRules())
                ->updateRules($this->optionalPasswordRules()),

            HasMany::make('Orders', 'orders', Order::class),
        ];
    }
}
