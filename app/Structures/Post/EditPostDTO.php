<?php

namespace App\Structures\Post;

use Spatie\LaravelData\Data;

final class EditPostDTO extends Data
{
    public function __construct(
        public readonly ?string $heading = null,
        public readonly ?string $body = null,
        public readonly ?bool $isDraft = null,
    ) {}
}
