<?php

namespace App\Http\Resources\Like;

use App\Enums\Likes\MorphModelsEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LikesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'model' => MorphModelsEnum::from($this->likeable_type)->name,
            'model_id' => $this->likeable_id,
            'author' => [
                'id' => $this->author->id,
                'name' => $this->author->name,
            ],
            'created_at' => $this->created_at,
        ];
    }
}
