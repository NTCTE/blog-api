<?php

namespace App\Structures\Post;

use Spatie\LaravelData\Data;

final class EditPostDTO extends Data
{
    public function __construct(
        public readonly string $heading,
        public readonly string $body,
        public readonly bool $isDraft = true,
    ) {}
}
