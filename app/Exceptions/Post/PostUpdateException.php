<?php

namespace App\Exceptions\Post;

use App\Exceptions\BaseException;

class PostUpdateException extends BaseException
{
    protected int $statusCode = 501;
    protected string $defaultMessage = 'post.exception.update';
    protected bool $shouldReport = true;
}
