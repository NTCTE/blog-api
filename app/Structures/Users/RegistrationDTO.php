<?php

namespace App\Structures\Users;

use Spatie\LaravelData\Data;

final class RegistrationDTO extends Data
{
    public function __construct(
        public string $name,
        public string $email,
        public string $password,
        public ?string $bio
    )
    {

    }
}
