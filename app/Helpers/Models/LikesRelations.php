<?php

namespace App\Helpers\Models;

use App\Models\Like;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait LikesRelations
{
    public function likes(): MorphMany
    {
        return $this->morphMany(Like::class, 'likeable')
            ->where('is_dislike', false);
    }

    public function dislikes(): MorphMany
    {
        return $this->morphMany(Like::class, 'likeable')
            ->where('is_dislike', true);
    }
}
