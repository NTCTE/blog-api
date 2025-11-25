<?php

namespace App\Exceptions\Post;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostAccessDeniedException extends Exception
{
    public function __construct(
        string $message = 'post.exception.denied',
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
        ], 403);
    }
}
