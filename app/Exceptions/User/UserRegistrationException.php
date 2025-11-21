<?php

namespace App\Exceptions\User;

use Exception;

class UserRegistrationException extends Exception
{
    public function __construct(
        string $message = __('user.registration.failed'),
        int $code = 0,
        ?\Throwable $previous = null
        )
    {
        parent::__construct($message, $code, $previous);
    }
}
