<?php

namespace App\Policies;

use App\Models\PurchaseOrder\CurrencyRate;
use App\Models\User;

class CurrencyRatePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view currency rates');
    }

    public function view(User $user, CurrencyRate $currencyRate): bool
    {
        return $user->can('view currency rates');
    }

    public function create(User $user): bool
    {
        return $user->can('create currency rates');
    }

    public function update(User $user, CurrencyRate $currencyRate): bool
    {
        return $user->can('update currency rates');
    }

    public function delete(User $user, CurrencyRate $currencyRate): bool
    {
        return $user->can('delete currency rates');
    }

    public function restore(User $user, CurrencyRate $currencyRate): bool
    {
        return $user->can('restore currency rates');
    }

    public function forceDelete(User $user, CurrencyRate $currencyRate): bool
    {
        return $user->can('force delete currency rates');
    }
}
