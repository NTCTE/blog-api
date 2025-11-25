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
     * @param  PostDTO $post DTO-сущность поста
     * @return Post при добавлении поста возвращается Eloquent-модель поста
     *
     * @throws PostCreateException если пост невозможно создать, выбрасывается исключение
     */
    public function create(PostDTO $post): Post;

    /**
     * Метод получения поста по его идентификатору
     *
     * @param  int $postId идентификатор поста
     * @return Post возвращается Eloquent-модель поста
     *
     * @throws PostNotFoundException если пост не обнаружен, выбрасывается исключение
     * @throws PostAccessDeniedException если пост находится в черновиках и пользователь не является автором, то выбрасывается исключение
     */
    public function read(int $postId): Post;

    /**
     * Метод обновления поста
     *
     * @param int $postId идентификатор поста
     * @param  EditPostDTO $post DTO-сущность изменяемого поста
     * @return Post возвращается возвращается Eloquent-модель поста
     *
     * @throws PostUpdateException при невозможности изменить пост выбрасывается исключение
     * @throws PostAccessDeniedException если пользователь пытается изменить не свой пост, выбрасывается исключение
     */
    public function update(int $postId, EditPostDTO $post): Post;

    /**
     * Метод удаления поста
     *
     * @param  int $postId идентификатор поста
     * @return void
     *
     * @throws PostNotFoundException если пост не найдет, выбрасывается исключение
     * @throws PostAccessDeniedException если пользователь, который не является автором поста пытается удалить пост, выбрасывается исключение
     */
    public function delete(int $postId): void;
}
