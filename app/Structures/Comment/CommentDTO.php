<?php

namespace App\Structures\Comment;

use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;

final class CommentDTO extends Data
{
    public function __construct(
        #[MapOutputName('body')]
        public readonly string $content,
        public readonly int $postId,
        public readonly int $authorId,
        #[MapOutputName('comment_id')]
        public readonly ?int $parentId = null,
    ) {}
}
