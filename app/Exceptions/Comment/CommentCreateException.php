<?php

namespace App\Exceptions\Comment;

use App\Exceptions\BaseException;

class CommentCreateException extends BaseException
{
    protected int $statusCode = 500;
    protected string $defaultMessage = 'comment.exception.create';
    protected bool $shouldReport = true;
}
