<?php

namespace App\Services\Comment;

use App\Contracts\Services\CommentServiceInterface;
use App\Exceptions\Comment\CommentAccessDeniedException;
use App\Exceptions\Comment\CommentCreateException;
use App\Exceptions\Comment\CommentNotFoundException;
use App\Models\Comment;
use App\Structures\Comment\CommentDTO;
use App\Structures\Comment\UpdateCommentDTO;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CommentService implements CommentServiceInterface
{
    private function queryWithRelations(): Builder
    {
        return Comment::with('author')
            ->withCount([
                'likes as likes_count' => fn ($query) => $query->likes(),
                'dislikes as dislikes_count' => fn ($query) => $query->dislikes(),
            ]);
    }

    public function create(CommentDTO $comment): Comment
    {
        try {
            return Comment::create($comment->toArray());
        } catch (\Throwable $e) {
            throw new CommentCreateException(previous: $e);
        }
    }

    public function read(int $commentId): Comment
    {
        try {
            return $this->queryWithRelations()
                ->findOrFail($commentId);
        } catch (ModelNotFoundException $e) {
            throw new CommentNotFoundException(previous: $e);
        }
    }

    public function update(int $userId, int $commentId, UpdateCommentDTO $content): Comment
    {
        try {
            $existingComment = $this->queryWithRelations()
                ->findOrFail($commentId);
        } catch (ModelNotFoundException $e) {
            throw new CommentNotFoundException(previous: $e);
        }

        if ($existingComment->author_id !== $userId) {
            throw new CommentAccessDeniedException();
        }

        $existingComment->fill($content->toArray())
            ->save();

        return $existingComment;
    }

    public function delete(int $userId, int $commentId): void
    {
        try {
            $existingComment = Comment::findOrFail($commentId);
        } catch (ModelNotFoundException $e) {
            throw new CommentNotFoundException(previous: $e);
        }

        if ($existingComment->author_id !== $userId) {
            throw new CommentAccessDeniedException();
        }

        $existingComment->delete();
    }

    public function listByPost(int $postId, int $perPage = 15): LengthAwarePaginator
    {
        return $this->queryWithRelations()
            ->where('post_id', $postId)
            ->whereNull('comment_id')
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function listByUser(int $userId, int $perPage = 15): LengthAwarePaginator
    {
        return $this->queryWithRelations()
            ->where('author_id', $userId)
            ->orderBy('created_at', 'desc')
            ->paginate($perPage);
    }

    public function listReplies(int $commentId, int $perPage = 15): LengthAwarePaginator
    {
        return $this->queryWithRelations()
            ->where('parent_id', $commentId)
            ->orderBy('created_at', 'asc')
            ->paginate($perPage);
    }
}
