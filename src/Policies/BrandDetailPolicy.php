<?php

namespace App\Policies;

use App\Models\PurchaseOrder\BrandDetail;
use App\Models\User;

class BrandDetailPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view brand details');
    }

    public function view(User $user, BrandDetail $brandDetail): bool
    {
        return $user->can('view brand details');
    }

    public function create(User $user): bool
    {
        return $user->can('create brand details');
    }

    public function update(User $user, BrandDetail $brandDetail): bool
    {
        return $user->can('update brand details');
    }

    public function delete(User $user, BrandDetail $brandDetail): bool
    {
        return $user->can('delete brand details');
    }

    public function restore(User $user, BrandDetail $brandDetail): bool
    {
        return $user->can('restore brand details');
    }

    public function forceDelete(User $user, BrandDetail $brandDetail): bool
    {
        return $user->can('force delete brand details');
    }
}
