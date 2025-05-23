<?php

namespace App\Policies;

use App\Models\PurchaseOrder\Cashier;
use App\Models\User;

class CashierPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view cashiers');
    }

    public function view(User $user, Cashier $cashier): bool
    {
        return $user->can('view cashiers');
    }

    public function create(User $user): bool
    {
        return $user->can('create cashiers');
    }

    public function update(User $user, Cashier $cashier): bool
    {
        return $user->can('update cashiers');
    }

    public function delete(User $user, Cashier $cashier): bool
    {
        return $user->can('delete cashiers');
    }

    public function restore(User $user, Cashier $cashier): bool
    {
        return $user->can('restore cashiers');
    }

    public function forceDelete(User $user, Cashier $cashier): bool
    {
        return $user->can('force delete cashiers');
    }
}
