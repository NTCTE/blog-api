<?php

namespace App\Http\Controllers\Post;

use App\Contracts\Services\PostServiceInterface;
use App\Http\Controllers\Controller;
use App\Http\Requests\Post\CreatePostRequest;
use App\Http\Requests\Post\FiltersRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Http\Resources\Post\PostResource;
use App\Structures\Post\EditPostDTO;
use App\Structures\Post\PostDTO;
use App\Structures\Post\PostFilterDTO;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct(
        private PostServiceInterface $service
    ) {}

    public function index(FiltersRequest $request): JsonResource
    {
        $filters = PostFilterDTO::from($request->validated());

        $posts = $this->service->list(
            $filters,
            $filters->per_page ?? 15,
            Auth::guard('sanctum')->id(),
        );

        return $posts->toResourceCollection(PostResource::class);
    }

    public function create(CreatePostRequest $request): JsonResource
    {
        $data = PostDTO::from($request->validated());

        $post = $this->service->create(
            Auth::id(),
            $data,
        );

        return $post->toResource(PostResource::class);
    }

    public function read(Request $request, int $id): JsonResource
    {
        $post = $this->service->read(
            $id,
            Auth::guard('sanctum')->id(),
        );

        return $post->toResource(PostResource::class);
    }

    public function update(UpdatePostRequest $request, int $id): JsonResource
    {
        $data = EditPostDTO::from($request->validated());

        $post = $this->service->update(
            Auth::id(),
            $id,
            $data,
        );

        return $post->toResource(PostResource::class);
    }

    public function delete(Request $request, int $id): JsonResponse
    {
        $this->service->delete(
            Auth::id(),
            $id,
        );

        return response()->json([], 204);
    }
}
