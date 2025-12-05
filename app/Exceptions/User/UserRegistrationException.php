<?php

namespace App\Exceptions\User;

use App\Exceptions\BaseException;

class UserRegistrationException extends BaseException
{
    protected int $statusCode = 422;
    protected string $defaultMessage = 'user.registration.failed';
    protected bool $shouldReport = false;
}
