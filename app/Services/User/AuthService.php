<?php

namespace App\Services\User;

use App\Contracts\Services\AuthServiceInterface;
use App\Exceptions\User\UserLoginException;
use App\Exceptions\User\UserRegistrationException;
use App\Models\User;
use App\Structures\Users\LoginDTO;
use App\Structures\Users\RegistrationDTO;
use Auth;
use Hash;

class AuthService implements AuthServiceInterface
{
    public function register(RegistrationDTO $user): User
    {
        if (User::where('email', $user->email)->exists()) {
            throw new UserRegistrationException();
        }

        try {
            return User::create($user->toArray());
        } catch (\Throwable $e) {
            report($e);

            throw new UserRegistrationException(previous: $e);
        }
    }

    public function login(LoginDTO $data): array
    {
        $user = User::where('email', $data->email)->first();

        if (!$user || !Hash::check($data->password, $user->password)) {
            throw new UserLoginException();
        }

        $token = $user->createToken(
            'auth_token',
            expiresAt: $data->remember ? now()->addMonth() : now()->addDay(),
        );

        return [
            'user' => $user,
            'token' => $token->plainTextToken,
        ];
    }

    public function spaLogin(LoginDTO $user): User
    {
        if (!Auth::attempt([
            'email' => $user->email,
            'password' => $user->password,
        ])) {
            throw new UserLoginException();
        }

        return Auth::user();
    }

    public function logout(): void
    {
        Auth::user()
            ->currentAccessToken()
            ->delete();
    }

    public function spaLogout(): void
    {
        Auth::logout();
    }

    public function refreshToken(User $user): string
    {
        $user->currentAccessToken()->delete();

        $token = $user->createToken('auth_token', expiresAt: now()->addDay());

        return $token->plainTextToken;
    }
}
