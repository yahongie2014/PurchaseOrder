<?php

namespace App\Policies;

use App\Models\PurchaseOrder\Category;
use App\Models\User;

class CategoryPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view categories');
    }

    public function view(User $user, Category $category): bool
    {
        return $user->can('view categories');
    }

    public function create(User $user): bool
    {
        return $user->can('create categories');
    }

    public function update(User $user, Category $category): bool
    {
        return $user->can('update categories');
    }

    public function delete(User $user, Category $category): bool
    {
        return $user->can('delete categories');
    }

    public function restore(User $user, Category $category): bool
    {
        return $user->can('restore categories');
    }

    public function forceDelete(User $user, Category $category): bool
    {
        return $user->can('force delete categories');
    }
}
