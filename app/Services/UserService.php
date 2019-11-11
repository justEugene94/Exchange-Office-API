<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    /**
     * @param string $username
     * @param string $password
     * @return bool
     */
    public function checkLegacyPassword(string $username, string $password): bool
    {
        /** @var User|null $user */
        $user = User::query()->where('name', $username)->first();

        if (!$user) {
            return false;
        }

        if ($legacyPasswordHash !== sha1($password)) {
            return false;
        }

        $user->password = Hash::make($password);
        $user->flushLegacyPasswordHash();
        $user->save();

        return true;
    }
}
