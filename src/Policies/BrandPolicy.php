<?php

namespace App\Policies;

use App\Models\PurchaseOrder\Brand;
use App\Models\User;

class BrandPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view brands');
    }

    public function view(User $user, Brand $brand): bool
    {
        return $user->can('view brands');
    }

    public function create(User $user): bool
    {
        return $user->can('create brands');
    }

    public function update(User $user, Brand $brand): bool
    {
        return $user->can('update brands');
    }

    public function delete(User $user, Brand $brand): bool
    {
        return $user->can('delete brands');
    }

    public function restore(User $user, Brand $brand): bool
    {
        return $user->can('restore brands');
    }

    public function forceDelete(User $user, Brand $brand): bool
    {
        return $user->can('force delete brands');
    }
}
