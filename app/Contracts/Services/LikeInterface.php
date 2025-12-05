<?php

namespace App\Contracts\Services;

use App\Exceptions\Like\LikeCreateException;
use App\Structures\Filters\PerPageDTO;
use App\Structures\Like\CreateLikeDTO;
use App\Structures\Like\DeleteLikeDTO;
use App\Structures\Like\ReadLikesDTO;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface LikeInterface
{
    /**
     * Метод создания лайка на необходимую модель
     *
     * @param  CreateLikeDTO $payload DTO с необходимыми данными для создания лайка
     * @param  int $userId идентификатор пользователя, который ставит лайк
     * @return bool возвращается true если лайк был поставлен. Если лайк был поставлен ранее, то false
     *
     * @throws LikeCreateException Если поставить лайк не удалось, выбрасывается Exception
     */
    public function create(CreateLikeDTO $payload, int $userId): bool;

    /**
     * Метод, который возвращает спагинированный список пользователей, которые поставили лайки
     *
     * @param  ReadLikesDTO $payload DTO с необходимыми данными для получения лайков
     * @param  PerPageDTO $perPage DTO с необходимыми данными для пагинации
     * @return ?LengthAwarePaginator спагинированный список пользователей, которые поставили лайки. Если пусто, то null.
     */
    public function read(ReadLikesDTO $payload, PerPageDTO $perPage): ?LengthAwarePaginator;

    /**
     * Удаление лайка пользователя с необходимой модели
     *
     * @param  DeleteLikeDTO $payload DTO с необходимыми данными для удаления лайка
     * @param  int $userId идентификатор пользователя
     * @return void
     *
     */
    public function delete(DeleteLikeDTO $payload, int $userId): void;
}
