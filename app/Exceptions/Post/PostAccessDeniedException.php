<?php

namespace App\Exceptions\Post;

use App\Exceptions\BaseException;

class PostAccessDeniedException extends BaseException
{
    protected int $statusCode = 403;
    protected string $defaultMessage = 'post.exception.denied';
    protected bool $shouldReport = false;
}
