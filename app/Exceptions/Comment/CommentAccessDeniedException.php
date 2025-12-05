<?php

namespace App\Exceptions\Comment;

use App\Exceptions\BaseException;

class CommentAccessDeniedException extends BaseException
{
    protected int $statusCode = 403;
    protected string $defaultMessage = 'comment.exception.denied';
    protected bool $shouldReport = false;
}
