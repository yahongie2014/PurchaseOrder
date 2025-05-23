<?php

namespace App\Policies;

use App\Models\PurchaseOrder\OrderItem;
use App\Models\User;

class OrderItemPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view order items');
    }

    public function view(User $user, OrderItem $orderItem): bool
    {
        return $user->can('view order items');
    }

    public function create(User $user): bool
    {
        return $user->can('create order items');
    }

    public function update(User $user, OrderItem $orderItem): bool
    {
        return $user->can('update order items');
    }

    public function delete(User $user, OrderItem $orderItem): bool
    {
        return $user->can('delete order items');
    }

    public function restore(User $user, OrderItem $orderItem): bool
    {
        return $user->can('restore order items'); // optional
    }

    public function forceDelete(User $user, OrderItem $orderItem): bool
    {
        return $user->can('force delete order items'); // optional
    }
}
