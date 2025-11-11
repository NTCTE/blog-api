<?php

namespace App\Structures\Users;

use Spatie\LaravelData\Data;

final class Registration extends Data
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public string $bio
    )
    {

    }
}
