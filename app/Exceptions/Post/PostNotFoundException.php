<?php

namespace App\Exceptions\Post;

use App\Exceptions\BaseException;

class PostNotFoundException extends BaseException
{
    protected int $statusCode = 404;
    protected string $defaultMessage = 'post.exception.not_found';
    protected bool $shouldReport = false;
}
