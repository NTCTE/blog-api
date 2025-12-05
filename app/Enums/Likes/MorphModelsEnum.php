<?php

namespace App\Enums\Likes;

use App\Models\Comment;
use App\Models\Post;

enum MorphModelsEnum: string
{
    case Post = Post::class;
    case Comment = Comment::class;
}
