<?php

namespace App\Structures\Users;

use Spatie\LaravelData\Data;

final class RegistrationDTO extends Data
{
    public function __construct(
        public readonly string $name,
        public readonly string $email,
        public readonly string $password,
        public readonly ?string $bio
    )
    {}
}
