<?php

namespace App\Http\Controllers\Like;

use App\Contracts\Services\LikeInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Like\CreateLikeRequest;
use App\Http\Requests\Like\DeleteLikeRequest;
use App\Http\Requests\Like\ReadLikesRequest;
use App\Http\Resources\Like\LikesResource;
use App\Structures\Filters\PerPageDTO;
use App\Structures\Like\CreateLikeDTO;
use App\Structures\Like\DeleteLikeDTO;
use App\Structures\Like\ReadLikesDTO;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
{
    public function __construct(
        private LikeInterface $service,
    ) {}

    public function create(CreateLikeRequest $request): JsonResponse
    {
        $data = CreateLikeDTO::from($request->validated());

        $wasCreated = $this->service
            ->create($data, Auth::guard('sanctum')->id());

        return response()->json([
            'was_created' => $wasCreated,
        ], 201);
    }

    public function read(ReadLikesRequest $request): JsonResource
    {
        $perPage = PerPageDTO::from($request);
        $data = ReadLikesDTO::from($request->validated());

        return $this->service
            ->read($data, $perPage)
            ->toResourceCollection(LikesResource::class);
    }

    public function delete(DeleteLikeRequest $request): JsonResponse
    {
        $data = DeleteLikeDTO::from($request->validated());

        $this->service
            ->delete($data, Auth::guard('sanctum')->id());

        return response()->json([], 204);
    }
}
