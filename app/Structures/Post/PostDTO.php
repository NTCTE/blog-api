<?php

namespace App\Structures\Post;

use Spatie\LaravelData\Data;

final class PostDTO extends Data
{
    public function __construct(
        public readonly string $heading,
        public readonly string $body,
        public readonly int $authorId,
        public readonly bool $isDraft = true,
    ) {}
}
