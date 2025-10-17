<?php

namespace App\Policies;

use App\Models\PurchaseOrder\ProductImage;
use App\Models\User;

class ProductImagePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view product images');
    }

    public function view(User $user, ProductImage $productImage): bool
    {
        return $user->can('view product images');
    }

    public function create(User $user): bool
    {
        return $user->can('create product images');
    }

    public function update(User $user, ProductImage $productImage): bool
    {
        return $user->can('update product images');
    }

    public function delete(User $user, ProductImage $productImage): bool
    {
        return $user->can('delete product images');
    }

    public function restore(User $user, ProductImage $productImage): bool
    {
        return $user->can('restore product images'); // Optional, add permission if you want
    }

    public function forceDelete(User $user, ProductImage $productImage): bool
    {
        return $user->can('force delete product images'); // Optional
    }
}
