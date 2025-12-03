<?php

namespace App\Contracts\Services;

use App\Enums\Likes\MorphModelsEnum;
use App\Exceptions\Like\LikeCreateException;
use App\Models\User;
use App\Structures\Filters\PerPageDTO;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface LikeInterface
{
    /**
     * Метод создания лайка на необходимую модель
     *
     * @param  MorphModelsEnum $model элемент из перечисляемого списка дозволенных моделей
     * @param  int $modelId идентификатор модели
     * @param  int $userId идентификатор пользователя
     * @param  bool $isLike если true, то ставится лайк. Если false, то дизлайк
     * @return bool возвращается true если лайк был поставлен. Если лайк был поставлен ранее, то false
     *
     * @throws LikeCreateException Если поставить лайк не удалось, выбрасывается Exception
     */
    public function create(MorphModelsEnum $model, int $modelId, int $userId, bool $isLike = true): bool;

    /**
     * Метод, который возвращает спагинированный список пользователей, которые поставили лайки
     *
     * @param  MorphModelsEnum $model элемент из перечисляемого списка дозволенных моделей
     * @param  int $modelId идентификатор модели
     * @param  bool $likes указатель, который указывает, что вернуть нужно лайки
     * @param  PerPageDTO $perPage количество комментариев на странице
     * @return ?LengthAwarePaginator спагинированный список пользователей, которые поставили лайки. Если пусто, то null.
     */
    public function read(MorphModelsEnum $model, int $modelId, bool $likes = true, PerPageDTO $perPage): ?LengthAwarePaginator;

    /**
     * Удаление лайка пользователя с необходимой модели
     *
     * @param  MorphModelsEnum $model элемент из перечисляемого списка дозволенных моделей
     * @param  int $modelId идентификатор модели
     * @param  int $userId идентификатор пользователя
     * @return void
     */
    public function delete(MorphModelsEnum $model, int $modelId, int $userId): void;
}
