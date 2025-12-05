<?php

namespace App\Exceptions\Like;

use App\Exceptions\BaseException;

class LikeCreateException extends BaseException
{
    protected int $statusCode = 500;
    protected string $defaultMessage = 'like.exception.create';
    protected bool $shouldReport = false;
}
