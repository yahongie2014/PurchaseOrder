<?php

namespace App\Policies;

use App\Models\PurchaseOrder\UserAddress;
use App\Models\User;

class UserAddressPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view user addresses');
    }

    public function view(User $user, UserAddress $userAddress): bool
    {
        return $user->can('view user addresses');
    }

    public function create(User $user): bool
    {
        return $user->can('create user addresses');
    }

    public function update(User $user, UserAddress $userAddress): bool
    {
        return $user->can('update user addresses');
    }

    public function delete(User $user, UserAddress $userAddress): bool
    {
        return $user->can('delete user addresses');
    }

    public function restore(User $user, UserAddress $userAddress): bool
    {
        return $user->can('restore user addresses');
    }

    public function forceDelete(User $user, UserAddress $userAddress): bool
    {
        return $user->can('force delete user addresses');
    }
}
