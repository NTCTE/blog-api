<?php

namespace App\Contracts\Services;

use App\Exceptions\Post\PostAccessDeniedException;
use App\Exceptions\Post\PostCreateException;
use App\Exceptions\Post\PostNotFoundException;
use App\Exceptions\Post\PostUpdateException;
use App\Models\Post;
use App\Structures\Post\EditPostDTO;
use App\Structures\Post\PostDTO;

interface PostServiceInterface
{
    /**
     * Метод создания поста
     *
     * @param  int $userId идентификатор пользователя, выполняющего запрос
     * @param  PostDTO $post DTO-сущность поста
     * @return Post при добавлении поста возвращается Eloquent-модель поста
     *
     * @throws PostCreateException если пост невозможно создать, выбрасывается исключение
     */
    public function create(int $userId, PostDTO $post): Post;

    /**
     * Метод получения поста по его идентификатору
     *
     * @param  int $postId идентификатор поста
     * @param  ?int $userId идентификатор пользователя, выполняющего запрос. Если пользователь не аутентифицирован, то передается null
     * @return Post возвращается Eloquent-модель поста
     *
     * @throws PostNotFoundException если пост не обнаружен, выбрасывается исключение
     * @throws PostAccessDeniedException если пост находится в черновиках и пользователь не является автором, то выбрасывается исключение
     */
    public function read(int $postId, ?int $userId = null): Post;

    /**
     * Метод обновления поста
     *
     * @param  int $userId идентификатор пользователя, выполняющего запрос
     * @param  int $postId идентификатор поста
     * @param  EditPostDTO $post DTO-сущность изменяемого поста
     * @return Post возвращается возвращается Eloquent-модель поста
     *
     * @throws PostUpdateException при невозможности изменить пост выбрасывается исключение
     * @throws PostAccessDeniedException если пользователь пытается изменить не свой пост, выбрасывается исключение
     * @throws PostNotFoundException если пост не найдет, выбрасывается исключение
     */
    public function update(int $userId, int $postId, EditPostDTO $post): Post;

    /**
     * Метод удаления поста
     *
     * @param  int $userId идентификатор пользователя, выполняющего запрос
     * @param  int $postId идентификатор поста
     * @return void
     *
     * @throws PostNotFoundException если пост не найдет, выбрасывается исключение
     * @throws PostAccessDeniedException если пользователь, который не является автором поста пытается удалить пост, выбрасывается исключение
     */
    public function delete(int $userId, int $postId): void;
}
