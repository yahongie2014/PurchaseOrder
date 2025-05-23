<?php

namespace App\Policies;

use App\Models\PurchaseOrder\ProductDetail;
use App\Models\User;

class ProductDetailPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view product details');
    }

    public function view(User $user, ProductDetail $productDetail): bool
    {
        return $user->can('view product details');
    }

    public function create(User $user): bool
    {
        return $user->can('create product details');
    }

    public function update(User $user, ProductDetail $productDetail): bool
    {
        return $user->can('update product details');
    }

    public function delete(User $user, ProductDetail $productDetail): bool
    {
        return $user->can('delete product details');
    }

    public function restore(User $user, ProductDetail $productDetail): bool
    {
        return $user->can('restore product details');
    }

    public function forceDelete(User $user, ProductDetail $productDetail): bool
    {
        return $user->can('force delete product details');
    }
}
