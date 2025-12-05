<?php

namespace App\Structures\Like;

use App\Enums\Likes\MorphModelsEnum;
use App\Helpers\Structures\Like\EnumNameCast;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Data;

final class ReadLikesDTO extends Data
{
    public function __construct(
        #[WithCast(EnumNameCast::class)]
        public readonly MorphModelsEnum $model,
        public readonly int $modelId,
        public readonly bool $isLike = true,
    ) {}
}
