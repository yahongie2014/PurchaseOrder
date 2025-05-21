<?php

namespace PurchaseOrder\Nova;

use Laravel\Nova\Resource;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\Json;
use Laravel\Nova\Http\Requests\NovaRequest;

class SyncLog extends Resource
{
    public static $model = \PurchaseOrder\Models\SyncLog::class;

    public static $title = 'entity_type';

    public static $search = ['id', 'entity_type', 'status'];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Entity Type')->sortable(),

            Text::make('Entity ID')->sortable(),

            Text::make('Status')->sortable(),

            DateTime::make('Synced At')->nullable(),

            Json::make('Response Data')->hideFromIndex(),

            DateTime::make('Created At')->sortable(),
            DateTime::make('Updated At')->sortable(),
        ];
    }
}
