<?php

namespace App\Contracts\Repositories;

use App\Entities\UserEntity;
use App\Models\User;
use App\Structures\Users\RegistrationDTO;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    public function create(RegistrationDTO $user): UserEntity;

    public function findById(int $id): ?UserEntity;

    public function findByEmail(string $email): ?UserEntity;

    public function findModelById(int $id): ?User;

    public function findModelByEmail(string $email): ?User;

    public function getAll(): Collection;

    public function getPaginated(int $perPage = 15): LengthAwarePaginator;
}
