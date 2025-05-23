<?php

namespace App\Policies;

use App\Models\PurchaseOrder\CategoryDetail;
use App\Models\User;

class CategoryDetailPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view category details');
    }

    public function view(User $user, CategoryDetail $categoryDetail): bool
    {
        return $user->can('view category details');
    }

    public function create(User $user): bool
    {
        return $user->can('create category details');
    }

    public function update(User $user, CategoryDetail $categoryDetail): bool
    {
        return $user->can('update category details');
    }

    public function delete(User $user, CategoryDetail $categoryDetail): bool
    {
        return $user->can('delete category details');
    }

    public function restore(User $user, CategoryDetail $categoryDetail): bool
    {
        return $user->can('restore category details');
    }

    public function forceDelete(User $user, CategoryDetail $categoryDetail): bool
    {
        return $user->can('force delete category details');
    }
}
