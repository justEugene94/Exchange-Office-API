<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class CoefficientPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

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
     * @param User $targetUser
     * @return bool
     */
    public function store(User $user, User $targetUser)
    {
        return $user->id === $targetUser->id;
    }

    /**
     * @param User $user
     * @param User $targetUser
     * @return bool
     */
    public function show(User $user, User $targetUser)
    {
        return true;
    }

    /**
     * @param User $user
     * @param User $targetUser
     * @return bool
     */
    public function update(User $user, User $targetUser)
    {
        return $user->id === $targetUser->id;
    }

    /**
     * @param User $user
     * @param User $targetUser
     * @return bool
     */
    public function destroy(User $user, User $targetUser)
    {
        return $user->id === $targetUser->id;
    }
}
