<?php

namespace App\Policies;

use App\Models\PurchaseOrder\Order;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class OrderPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view orders');
    }

    public function view(User $user, Order $order): bool
    {
        return $user->can('view orders');
    }

    public function create(User $user): bool
    {
        return $user->can('create orders');
    }

    public function update(User $user, Order $order): bool
    {
        return $user->can('update orders');
    }

    public function delete(User $user, Order $order): bool
    {
        return $user->can('delete orders');
    }

    public function restore(User $user, Order $order): bool
    {
        return $user->can('restore orders');
    }

    public function forceDelete(User $user, Order $order): bool
    {
        return $user->can('force delete orders');
    }
}
