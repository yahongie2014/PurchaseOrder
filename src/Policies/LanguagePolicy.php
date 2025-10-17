<?php

namespace App\Policies;

use App\Models\PurchaseOrder\Language;
use App\Models\User;

class LanguagePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view languages');
    }

    public function view(User $user, Language $language): bool
    {
        return $user->can('view languages');
    }

    public function create(User $user): bool
    {
        return $user->can('create languages');
    }

    public function update(User $user, Language $language): bool
    {
        return $user->can('update languages');
    }

    public function delete(User $user, Language $language): bool
    {
        return $user->can('delete languages');
    }

    public function restore(User $user, Language $language): bool
    {
        return $user->can('restore languages');
    }

    public function forceDelete(User $user, Language $language): bool
    {
        return $user->can('force delete languages');
    }
}
