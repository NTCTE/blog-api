<?php

namespace App\Http\Resources\Comment;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'author' => [
                'id' => $this->author->id,
                'name' => $this->author->name,
            ],
            'content' => $this->body,
            'likes_count' => $this->likes_count ?? 0,
            'dislikes_count' => $this->dislikes_count ?? 0,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
