<?php

namespace App\Structures\Comment;

use Spatie\LaravelData\Attributes\MapOutputName;
use Spatie\LaravelData\Data;

final class UpdateCommentDTO extends Data
{

    public function __construct(
        #[MapOutputName('body')]
        public readonly string $content,
    ) {}
}
