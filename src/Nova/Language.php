<?php

namespace App\Nova\PurchaseOrder;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Resource;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Http\Requests\NovaRequest;
use App\Models\PurchaseOrder\Language as LanguageModel;

class Language extends Resource
{
    public static $model = LanguageModel::class;

    public static $title = 'name';

    public static $search = [
        'id', 'code', 'name',
    ];

    public function fields(NovaRequest $request): array
    {
        return [
            ID::make()->sortable(),

            Text::make('Code')
                ->rules('required', 'max:10')
                ->sortable(),

            Text::make('Name')
                ->rules('required', 'max:255')
                ->sortable(),

            Select::make('Direction')
                ->options([
                    'ltr' => 'Left to Right',
                    'rtl' => 'Right to Left',
                ])
                ->rules('required')
                ->displayUsingLabels()
                ->sortable(),

            Boolean::make('Active', 'is_active')
                ->trueValue(1)
                ->falseValue(0)
                ->sortable(),
        ];
    }

    public function cards(NovaRequest $request): array
    {
        return [];
    }

    public function filters(NovaRequest $request): array
    {
        return [];
    }

    public function lenses(NovaRequest $request): array
    {
        return [];
    }

    public function actions(NovaRequest $request): array
    {
        return [];
    }

    public static function authorizedToViewAny(Request $request)
    {
        $user = $request->user();

        return $user && $user->hasRole('admin');
    }

    // Instance method, no static, accepts Illuminate\Http\Request
    public function authorizedToView(Request $request)
    {
        $user = $request->user();

        return $user && $user->hasRole('admin');
    }

    public static function authorizedToCreate(Request $request)
    {
        $user = $request->user();

        return $user && $user->hasRole('admin');
    }

    public function authorizedToUpdate(Request $request)
    {
        $user = $request->user();
        return $user && $user->hasRole('admin');
    }

}
