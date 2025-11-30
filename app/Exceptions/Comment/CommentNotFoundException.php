<?php

namespace App\Exceptions\Comment;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommentNotFoundException extends Exception
{
    public function __construct(
        string $message = 'comment.exception.not_found',
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
        ], 404);
    }
}
