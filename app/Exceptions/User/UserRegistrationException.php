<?php

namespace App\Exceptions\User;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserRegistrationException extends Exception
{
    public function __construct(
        string $message = 'user.registration.failed',
        int $code = 0,
        ?\Throwable $previous = null
        )
    {
        parent::__construct(__($message), $code, $previous);
    }

    public function report(): null
    {
        return null;
    }

    public function render(Request $request): JsonResponse
    {
        return new JsonResponse([
            'message' => $this->message,
        ], 422);
    }
}
