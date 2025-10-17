<?php

namespace App\Policies;

use App\Models\PurchaseOrder\SyncLog;
use App\Models\User;

class SyncLogPolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view sync logs');
    }

    public function view(User $user, SyncLog $syncLog): bool
    {
        return $user->can('view sync logs');
    }

    public function create(User $user): bool
    {
        return $user->can('create sync logs'); // optional, if applicable
    }

    public function update(User $user, SyncLog $syncLog): bool
    {
        return $user->can('update sync logs'); // optional, if applicable
    }

    public function delete(User $user, SyncLog $syncLog): bool
    {
        return $user->can('delete sync logs'); // optional, if applicable
    }

    public function restore(User $user, SyncLog $syncLog): bool
    {
        return $user->can('restore sync logs'); // optional, if applicable
    }

    public function forceDelete(User $user, SyncLog $syncLog): bool
    {
        return $user->can('force delete sync logs'); // optional, if applicable
    }
}
