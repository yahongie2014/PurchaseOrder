<?php

namespace App\Nova\PurchaseOrder;

use Illuminate\Http\Request;
use Laravel\Nova\Resource;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsToMany;
use Spatie\Permission\Models\Role as RoleModel;

use App\Nova\User;

class Role extends Resource
{
    public static $model = RoleModel::class;

    public static $title = 'name';

    public static $search = [
        'id', 'name'
    ];

    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Text::make('Name')
                ->rules('required', 'max:255')
                ->sortable(),

            BelongsToMany::make('Permissions', 'permissions', Permission::class),
            BelongsToMany::make('Users', 'users', User::class),
        ];
    }

    public static function authorizedToViewAny(Request $request)
    {
        $user = $request->user();

        return $user && $user->hasRole('admin');
    }

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
