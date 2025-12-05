<?php

namespace App\Structures\Post;

use Spatie\LaravelData\Data;

final class PostFilterDTO extends Data
{
    public function __construct(
        public readonly ?string $authorId = null,
        public readonly ?string $searchTerm = null,
        public readonly ?bool $isDraft = null,
        public readonly string $sortBy = 'created_at',
        public readonly string $sortOrder = 'desc',
    ) {}
}
