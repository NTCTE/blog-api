<?php

namespace App\Exceptions\User;

use App\Exceptions\BaseException;

class UserLoginException extends BaseException
{
    protected int $statusCode = 401;
    protected string $defaultMessage = 'user.login.failed';
    protected bool $shouldReport = false;
}
