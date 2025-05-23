<?php

namespace App\Policies;

use Spatie\Permission\Models\Permission;
use App\Models\User;

class PermissionPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('manage permissions');
    }

    public function view(User $user, Permission $permission): bool
    {
        return $user->can('manage permissions');
    }

    public function create(User $user): bool
    {
        return $user->can('manage permissions');
    }

    public function update(User $user, Permission $permission): bool
    {
        return $user->can('manage permissions');
    }

    public function delete(User $user, Permission $permission): bool
    {
        return $user->can('manage permissions');
    }
}
