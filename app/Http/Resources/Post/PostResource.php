<?php

namespace App\Http\Resources\Post;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
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
            'heading' => $this->heading,
            'body' => $this->body,
            'is_draft' => $this->is_draft,
            'author' => [
                'id' => $this->author->id,
                'name' => $this->author->name,
            ],
            'likes_count' => $this->likes_count ?? 0,
            'dislikes_count' => $this->dislikes_count ?? 0,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
