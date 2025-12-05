<?php

namespace App\Services\Like;

use App\Contracts\Services\LikeInterface;
use App\Models\Like;
use App\Structures\Filters\PerPageDTO;
use App\Structures\Like\CreateLikeDTO;
use App\Structures\Like\DeleteLikeDTO;
use App\Structures\Like\ReadLikesDTO;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class LikeService implements LikeInterface
{
    public function create(CreateLikeDTO $payload, int $userId): bool
    {
        $like = Like::where('likeable_type', $payload->model->value)
            ->where('likeable_id', $payload->modelId)
            ->where('author_id', $userId);

        if ($like->count() == 0) {
            Like::create([
                'likeable_type' => $payload->model->value,
                'likeable_id' => $payload->modelId,
                'author_id' => $userId,
                'is_dislike' => !$payload->isLike,
            ]);

            return true;
        }

        if ($like->count() == 1) {
            $existingLike = $like->first();

            if ($existingLike->is_dislike !== !$payload->isLike) {
                $existingLike->is_dislike = !$payload->isLike;
                $existingLike->save();

                return true;
            }
        }

        return false;
    }

    public function read(ReadLikesDTO $payload, PerPageDTO $perPage): ?LengthAwarePaginator
    {
        return Like::where('likeable_type', $payload->model->value)
            ->where('likeable_id', $payload->modelId)
            ->where('is_dislike', !$payload->isLike)
            ->with('author')
            ->paginate($perPage->perPage);
    }

    public function delete(DeleteLikeDTO $payload, int $userId): void
    {
        $like = Like::where('likeable_type', $payload->model->value)
            ->where('likeable_id', $payload->modelId)
            ->where('author_id', $userId);

        if ($like->count() > 0) {
            $like->delete();
        }
    }
}
