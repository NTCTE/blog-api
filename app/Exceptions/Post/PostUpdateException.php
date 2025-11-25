<?php

namespace App\Exceptions\Post;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostUpdateException extends Exception
{
    public function __construct(
        string $message = 'post.exception.update',
        int $code = 0,
        ?\Throwable $previous = null
    )
    {
        parent::__construct(__($message), $code, $previous);
    }

    public function render(Request $request): JsonResponse
    {
        return new JsonResponse([
            'message' => $this->message,
        ], 501);
    }
}
