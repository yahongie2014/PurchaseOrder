<?php

namespace App\Policies;

use App\Models\PurchaseOrder\Customer;
use App\Models\User;

class CustomerPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view customers');
    }

    public function view(User $user, Customer $customer): bool
    {
        return $user->can('view customers');
    }

    public function create(User $user): bool
    {
        return $user->can('create customers');
    }

    public function update(User $user, Customer $customer): bool
    {
        return $user->can('update customers');
    }

    public function delete(User $user, Customer $customer): bool
    {
        return $user->can('delete customers');
    }

    public function restore(User $user, Customer $customer): bool
    {
        return $user->can('restore customers'); // optional
    }

    public function forceDelete(User $user, Customer $customer): bool
    {
        return $user->can('force delete customers'); // optional
    }
}
