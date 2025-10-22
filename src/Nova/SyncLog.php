<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Code;
use Laravel\Nova\Resource;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Http\Requests\NovaRequest;

class SyncLog extends Resource
{
    public static $model = \App\Models\PurchaseOrder\SyncLog::class;

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
            Code::make('Response Data')->json()->hideFromIndex(),
            DateTime::make('Created At')->sortable(),
            DateTime::make('Updated At')->sortable(),
        ];
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

    public function authorizedToUpdate(Request $request)
    {
        $user = $request->user();

        return $user && $user->hasRole('admin');
    }

    public function authorizedToDelete(Request $request)
    {
        $user = $request->user();

        return $user && $user->hasRole('admin');
    }

    public static function availableForNavigation(Request $request)
    {
        $user = $request->user();

        return $user && $user->hasRole('admin');
    }
}
