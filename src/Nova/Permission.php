<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Resource;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsToMany;
use Spatie\Permission\Models\Permission as PermissionModel;
use Laravel\Nova\Http\Requests\NovaRequest;
use App\Nova\User;
use Illuminate\Support\Facades\Schema;

class Permission extends Resource
{
    public static $model = PermissionModel::class;

    public static $title = 'name';

    public static $search = [
        'id',
        'name'
    ];

    public function fields(NovaRequest $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Name')
                ->rules('required', 'max:255')
                ->sortable(),

            BelongsToMany::make('Roles', 'roles', Role::class),
            BelongsToMany::make('Users', 'users', User::class),
        ];
    }

    // Must be static and accept Illuminate\Http\Request
    public static function authorizedToViewAny(Request $request)
    {
        // If Spatie Permission tables haven't been migrated yet, avoid querying them.
        if (!Schema::hasTable('permissions')) {
            return false;
        }

        $user = $request->user();

        return $user && $user->hasRole('admin');
    }

    // Instance method, no static, accepts Illuminate\Http\Request
    public function authorizedToView(Request $request)
    {
        if (!Schema::hasTable('permissions')) {
            return false;
        }

        $user = $request->user();

        return $user && $user->hasRole('admin');
    }

    public function authorizedToUpdate(Request $request)
    {
        if (!Schema::hasTable('permissions')) {
            return false;
        }

        $user = $request->user();

        return $user && $user->hasRole('admin');
    }

    public function authorizedToDelete(Request $request)
    {
        if (!Schema::hasTable('permissions')) {
            return false;
        }

        $user = $request->user();

        return $user && $user->hasRole('admin');
    }

    // Optionally restrict navigation
    public static function availableForNavigation(Request $request)
    {
        if (!Schema::hasTable('permissions')) {
            return false;
        }

        $user = $request->user();

        return $user && $user->hasRole('admin');
    }
}
