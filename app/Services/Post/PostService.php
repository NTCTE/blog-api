<?php

namespace App\Services\Post;

use App\Contracts\Services\PostServiceInterface;
use App\Exceptions\Post\PostAccessDeniedException;
use App\Exceptions\Post\PostCreateException;
use App\Exceptions\Post\PostNotFoundException;
use App\Exceptions\Post\PostUpdateException;
use App\Structures\Post\PostDTO;
use App\Models\Post;
use App\Structures\Post\EditPostDTO;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Throwable;

class PostService implements PostServiceInterface
{
    public function create(int $userId, PostDTO $post): Post
    {
        try {
            return Post::create(array_merge(
                $post->toArray(),
                ['author_id' => $userId],
            ));
        } catch (Throwable $e) {
            throw new PostCreateException(previous: $e);
        }
    }

    public function update(int $userId, int $postId, EditPostDTO $post): Post
    {
        try {
            $existingPost = Post::with('author')
                ->withCount([
                    'likes as likes_count' => fn ($query) => $query->likes(),
                    'dislikes as dislikes_count' => fn ($query) => $query->dislikes(),
                ])
                ->findOrFail($postId);
        } catch (ModelNotFoundException $e) {
            throw new PostNotFoundException(previous: $e);
        }

        if ($existingPost->author_id !== $userId) {
            throw new PostAccessDeniedException();
        }

        try {
            $dataToUpdate = array_filter(
                $post->toArray(),
                fn ($value) => !is_null($value)
            );
            if (!empty($dataToUpdate)) {
                $existingPost->update($dataToUpdate);
            }
        } catch (Throwable $e) {
            throw new PostUpdateException(previous: $e);
        }

        return $existingPost;
    }

    public function read(int $postId, ?int $userId = null): Post
    {
        try {
            $post = Post::with('author')
                ->withCount([
                    'likes as likes_count' => fn ($query) => $query->likes(),
                    'dislikes as dislikes_count' => fn ($query) => $query->dislikes(),
                ])
                ->findOrFail($postId);
        } catch (ModelNotFoundException $e) {
            throw new PostNotFoundException(previous: $e);
        }

        if ($post->is_draft && $post->author_id !== $userId) {
            throw new PostAccessDeniedException();
        }

        return $post;
    }

    public function delete(int $userId, int $postId): void
    {
        try {
            $post = Post::findOrFail($postId);
        } catch (ModelNotFoundException $e) {
            throw new PostNotFoundException(previous: $e);
        }

        if ($post->author_id !== $userId) {
            throw new PostAccessDeniedException();
        }

        $post->delete();
    }
}
