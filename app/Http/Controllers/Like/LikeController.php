<?php

namespace App\Http\Controllers\Like;

use App\Contracts\Services\LikeInterface;
use App\Enums\Likes\MorphModelsEnum;
use App\Http\Controllers\Controller;
use App\Http\Requests\Filters\PerPageRequest;
use App\Http\Requests\Like\CreateLikeRequest;
use App\Http\Resources\Like\LikesResource;
use App\Structures\Filters\PerPageDTO;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function __construct(
        private LikeInterface $service,
    ) {}

    public function create(CreateLikeRequest $request): JsonResponse
    {
        return response()
            ->json(status: $this->service
                ->create($model, $modelId, Auth::guard('sanctum')->id(), $isLike) ?
                    204 :
                    411
            );
    }

    public function read(PerPageRequest $request, MorphModelsEnum $model, int $modelId, bool $isLike): JsonResponse
    {
        $likes = $this->service
            ->read($model, $modelId, $isLike, PerPageDTO::from($request));

        return $likes->toResourceCollection(LikesResource::class);
    }

    public function delete(MorphModelsEnum $model, int $modelId): JsonResponse
    {
        $this->service
            ->delete($model, $modelId, Auth::guard('sanctum')->id());

        return response()->json(status: 204);
    }
}
