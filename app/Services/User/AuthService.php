<?php

namespace App\Services\User;

use App\Contracts\Services\AuthServiceInterface;
use App\Exceptions\User\UserRegistrationException;
use App\Models\User;
use App\Structures\Users\RegistrationDTO;

class AuthService implements AuthServiceInterface
{
    public function register(RegistrationDTO $user): User
    {
        try {
            return User::create($user->toArray());
        } catch (\Exception $e) {
            throw new UserRegistrationException(previous: $e);
        }
    }
}
