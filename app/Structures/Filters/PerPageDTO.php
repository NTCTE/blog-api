<?php

namespace App\Structures\Filters;

use Spatie\LaravelData\Data;

final class PerPageDTO extends Data
{

    public function __construct(
        public readonly int $perPage = 15,
    ) {}
}
