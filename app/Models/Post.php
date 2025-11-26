<?php

namespace App\Models;

use App\Helpers\Models\LikesRelations;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Post extends Model
{
    use HasFactory;
    use LikesRelations;

    protected $fillable = [
        'heading',
        'body',
        'author_id',
        'is_draft',
    ];

    protected function casts(): array {
        return [
            'is_draft' => 'boolean',
        ];
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id', 'id');
    }

    public function scopePublished(Builder $query): void
    {
        $query->where('is_draft', false);
    }

    public function scopeDraft(Builder $query): void
    {
        $query->where('is_draft', true);
    }
}
