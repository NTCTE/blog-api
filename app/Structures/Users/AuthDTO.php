<?php

namespace App\Structures\Users;

use Spatie\LaravelData\Data;

final class AuthDTO extends Data
{
    public function __construct(
        public readonly string $email,
        public readonly string $password,
        public readonly bool $remember = false,
    )
    {

    }
}
