<?php

namespace App\Contracts\Services;

use App\Exceptions\Comment\CommentAccessDeniedException;
use App\Exceptions\Comment\CommentCreateException;
use App\Exceptions\Comment\CommentNotFoundException;
use App\Models\Comment;
use App\Structures\Comment\CommentDTO;
use App\Structures\Comment\UpdateCommentDTO;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CommentServiceInterface
{
    /**
     * Метод создания комментария
     *
     * @param  CommentDTO $comment DTO-сущность комментария
     * @return Comment возвращается Eloquent-модель созданного комментария
     *
     * @throws CommentCreateException в случае ошибки при создании комментария
     */
    public function create(CommentDTO $comment): Comment;

    /**
     * Метод получения комментария по идентификатору
     *
     * @param  int $commentId идентификатор комментария
     * @return Comment возвращается Eloquent-модель комментария
     *
     * @throws CommentNotFoundException если комментарий с указанным идентификатором не найден
     */
    public function read(int $commentId): Comment;

    /**
     * Метод обновления комментария
     *
     * @param  int $userId идентификатор пользователя, выполняющего запрос
     * @param  int $commentId идентификатор комментария, в котором выполняется обновление
     * @param  UpdateCommentDTO $comment содержимое комментария
     * @return Comment возвращается Eloquent-модель обновленного комментария
     *
     * @throws CommentNotFoundException если комментарий с указанным идентификатором не найден
     * @throws CommentAccessDeniedException если пользователь не имеет прав на обновление комментария
     */
    public function update(int $userId, int $commentId, UpdateCommentDTO $comment): Comment;

    /**
     * Метод удаления комментария
     *
     * @param  int $userId идентификатор пользователя, выполняющего запрос
     * @param  int $commentId идентификатор комментария, который необходимо удалить
     * @return void
     *
     * @throws CommentNotFoundException если комментарий с указанным идентификатором не найден
     * @throws CommentAccessDeniedException если пользователь не имеет прав на удаление комментария
     */
    public function delete(int $userId, int $commentId): void;

    /**
     * Метод получения списка комментариев по идентификатору поста
     *
     * @param  int $postId идентификатор поста
     * @param  int $perPage количество комментариев на странице
     * @return LengthAwarePaginator возвращается пагинированный список комментариев
     *
     */
    public function listByPost(int $postId, int $perPage = 15): LengthAwarePaginator;

    /**
     * Метод получения списка комментариев по идентификатору пользователя
     *
     * @param  int $userId идентификатор пользователя
     * @param  int $perPage количество комментариев на странице
     * @return LengthAwarePaginator возвращается пагинированный список комментариев
     *
     */
    public function listByUser(int $userId, int $perPage = 15): LengthAwarePaginator;

    /**
     * Метод получения списка ответов на комментарий по идентификатору комментария
     *
     * @param  int $commentId идентификатор комментария
     * @param  int $perPage количество комментариев на странице
     * @return LengthAwarePaginator возвращается пагинированный список комментариев
     *
     * @throws CommentNotFoundException если комментарий с указанным идентификатором не найден
     */
    public function listReplies(int $commentId, int $perPage = 15): LengthAwarePaginator;
}
