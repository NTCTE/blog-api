<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'author_id',
        'likeable_type',
        'likeable_id',
        'is_dislike',
    ];

    protected function casts(): array {
        return [
            'is_dislike' => 'boolean',
        ];
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    public function likeable(): MorphTo
    {
        return $this->morphTo();
    }

    public function scopeLikes(Builder $query): void
    {
        $query->where('is_dislike', false);
    }

    public function scopeDislikes(Builder $query): void
    {
        $query->where('is_dislike', true);
    }
}
