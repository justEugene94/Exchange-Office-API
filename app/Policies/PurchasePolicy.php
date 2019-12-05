<?php

namespace App\Policies;

use App\Models\Purchase;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class PurchasePolicy
{
    use HandlesAuthorization;

    /**
     * @param User $user
     * @param User $targetUser
     * @return bool
     */
    public function list(User $user, User $targetUser)
    {
        return $user->id === $targetUser->id;
    }

    /**
     * @param User $user
     * @return bool
     */
    public function store(?User $user)
    {
        return true;
    }
}
