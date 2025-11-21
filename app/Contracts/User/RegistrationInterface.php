<?php

namespace App\Contracts\User;

use App\Exceptions\User\UserRegistrationException;
use App\Models\User;
use App\Structures\Users\RegistrationDTO;

interface RegistrationInterface
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
}
