<?php

namespace App\Http\Controllers\Comment;

use App\Contracts\Services\CommentServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Comment\CreateCommentRequest;
use App\Http\Requests\Comment\UpdateCommentRequest;
use App\Http\Requests\Filters\PerPageRequest;
use App\Http\Resources\Comment\CommentResource;
use App\Structures\Comment\CommentDTO;
use App\Structures\Comment\UpdateCommentDTO;
use App\Structures\Filters\PerPageDTO;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\JsonResponse;

class CommentController extends Controller
{
    public function __construct(
        private CommentServiceInterface $service,
    ) {}

    public function create(CreateCommentRequest $request): JsonResource
    {
        $data = CommentDTO::from($request->validated(), [
            'author_id' => Auth::guard('sanctum')->id(),
        ]);

        return $this->service
            ->create($data)
            ->toResource(CommentResource::class);
    }

    public function read(int $commentId): JsonResource
    {
        return $this->service
            ->read($commentId)
            ->toResource(CommentResource::class);
    }

    public function update(UpdateCommentRequest $request, int $commentId): JsonResource
    {
        $data = UpdateCommentDTO::from($request);

        return $this->service
            ->update(
                Auth::guard('sanctum')->id(),
                $commentId,
                $data
            )
            ->toResource(CommentResource::class);
    }

    public function delete(int $commentId): JsonResponse
    {
        $this->service
            ->delete(
                Auth::guard('sanctum')->id(),
                $commentId
            );

        return response()->json(status: 204);
    }

    public function byPost(PerPageRequest $request, int $postId): JsonResource
    {
        $filters = PerPageDTO::from($request->validated());

        return $this->service
            ->listByPost($postId, $filters->perPage)
            ->toResourceCollection(CommentResource::class);
    }

    public function byUser(PerPageRequest $request, int $userId): JsonResource
    {
        $filters = PerPageDTO::from($request->validated());

        return $this->service
            ->listByUser($userId, $filters->perPage)
            ->toResourceCollection(CommentResource::class);
    }

    public function replies(PerPageRequest $request, int $commentId): JsonResource
    {
        $filters = PerPageDTO::from($request->validated());

        return $this->service
            ->listReplies($commentId, $filters->perPage)
            ->toResourceCollection(CommentResource::class);
    }
}
