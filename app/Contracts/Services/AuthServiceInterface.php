<?php

namespace App\Contracts\Services;

use App\Exceptions\User\UserLoginException;
use App\Exceptions\User\UserRegistrationException;
use App\Models\User;
use App\Structures\Users\{LoginDTO, RegistrationDTO};

interface AuthServiceInterface
{
    /**
     * Функция регистрации пользователей в системе.
     *
     * @param  RegistrationDTO $user DTO-структура регистрации пользователя
     * @return User Возвращается Eloquent-модель зарегистрированного пользователя
     *
     * @throws UserRegistrationException Если регистрация не удалась - выбрасывается Exception
     */
    public function register(RegistrationDTO $user): User;

    /**
     * Функция аутентификации пользователя в системе.
     *
     * @param LoginDTO $user DTO-структура аутентификации пользователя
     * @return array{0: User, 1: string} Массив с Eloquent-моделью пользователя и токеном
     *
     * @throws UserLoginException Если авторизация не удалась
     */
    public function login(LoginDTO $user): array;

    /**
     * Функция выхода пользователя из системы.
     *
     * @return void
     */
    public function logout(): void;

    /**
     * Функция обновления токена пользователя.
     *
     * @param  User $user Eloquent-модель пользователя
     * @return string Новый токен пользователя
     */
    public function refreshToken(User $user): string;
}
