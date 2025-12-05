<?php

namespace App\Exceptions\Comment;

use App\Exceptions\BaseException;

class CommentUpdateException extends BaseException
{
    protected int $statusCode = 501;
    protected string $defaultMessage = 'comment.exception.update';
    protected bool $shouldReport = true;
}
