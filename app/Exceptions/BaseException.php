<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

abstract class BaseException extends Exception
{
    protected int $statusCode = 500;
    protected string $defaultMessage = 'exception.general';
    protected bool $shouldReport = false;

    public function __construct(
        string $message = '',
        int $code = 0,
        ?\Throwable $previous = null
    ) {
        $finalMessage = $message ?: $this->defaultMessage;
        parent::__construct(__($finalMessage), $code, $previous);
    }

    public function report(): ?bool
    {
        return $this->shouldReport ? true : null;
    }

    public function render(Request $request): JsonResponse
    {
        return new JsonResponse([
            'message' => $this->message,
        ], $this->statusCode);
    }
}
