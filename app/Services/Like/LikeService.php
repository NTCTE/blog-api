<?php

namespace App\Services\Like;

use App\Contracts\Services\LikeInterface;
use App\Enums\Likes\MorphModelsEnum;
use App\Models\Like;
use App\Structures\Filters\PerPageDTO;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class LikeService implements LikeInterface
{
    public function create(MorphModelsEnum $model, int $modelId, int $userId, bool $isLike = true): bool
    {
        $like = Like::where('likeable_type', $model->value)
            ->where('likeable_id', $modelId)
            ->where('author_id', $userId)
            ->where('is_dislike', !$isLike);

        if ($like->count() == 0) {
            $like->fill([
                'author_id' => $userId,
                'likeable_type' => $model->value,
                'likeable_id' => $modelId,
                'is_dislike' => !$isLike,
            ])->save();

            return true;
        }

        return false;
    }

    public function read(MorphModelsEnum $model, int $modelId, bool $likes = true, PerPageDTO $perPage): ?LengthAwarePaginator
    {
        $returned = $model->value::find($modelId);

        if ($returned === null) {
            return null;
        }

        return $returned->likes()
            ->where('is_dislike', !$likes)
            ->paginate();
    }

    public function delete(MorphModelsEnum $model, int $modelId, int $userId): void
    {
        Like::where('likeable_type', $model->value)
            ->where('likeable_id', $modelId)
            ->where('author_id', $userId)
            ->delete();
    }
}
