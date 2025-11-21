<?php

namespace App\Structures\Users;

use Spatie\LaravelData\Data;

final class AuthDTO extends Data
{
    public function __construct(
        public string $email,
        public string $password,
    )
    {

    }
}
