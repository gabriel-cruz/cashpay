<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    public function __construct(
        public UserRepository $repository
    ){}

    public function getUserById(int $userId)
    {
        return $this->repository->findUserById($userId);
    }

    public function getUserType(int $userId): string
    {
        return $this->repository->getUserType($userId);
    }

    public function userCanTransfer(int $userId): bool
    {
        if ($this->getUserType($userId) !== 'common') {
            return false;
        }
        return true;
    }
}
