<?php

namespace App\Exceptions\Comment;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommentCreateException extends Exception
{
    public function __construct(
        string $message = 'comment.exception.create',
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
        ], 500);
    }
}
