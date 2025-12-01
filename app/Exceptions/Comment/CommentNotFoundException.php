<?php

namespace App\Exceptions\Comment;

use App\Exceptions\BaseException;

class CommentNotFoundException extends BaseException
{
    protected int $statusCode = 404;
    protected string $defaultMessage = 'comment.exception.not_found';
    protected bool $shouldReport = false;
}
