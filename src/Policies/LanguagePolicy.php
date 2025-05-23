<?php

namespace App\Policies;

use App\Models\PurchaseOrder\Language;
use App\Models\User;

class LanguagePolicy
{
    public function viewAny(User $user)
    {
        return $user->hasRole('view languages');
    }

    public function view(User $user, Language $language)
    {
        return $user->hasRole('view languages');
    }

    public function create(User $user)
    {
        return $user->hasRole('create languages');
    }

    public function update(User $user, Language $language)
    {
        return $user->hasRole('update languages');
    }

    public function delete(User $user, Language $language)
    {
        return $user->hasRole('delete languages');
    }

    public function restore(User $user, Language $language)
    {
        return $user->hasRole('restore languages');
    }

    public function forceDelete(User $user, Language $language)
    {
        return $user->hasRole('force delete languages');
    }
}
