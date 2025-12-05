<?php

namespace App\Exceptions\Post;

use App\Exceptions\BaseException;

class PostCreateException extends BaseException
{
    protected int $statusCode = 500;
    protected string $defaultMessage = 'post.exception.create';
    protected bool $shouldReport = true;
}
