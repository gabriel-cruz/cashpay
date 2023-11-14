<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    public function getUserById(int $userId){
        $repository = new UserRepository();

        return $repository->findUserById($userId);
    }

    public function getUserType(int $userId): string{
        $repository = new UserRepository();

        return $repository->getUserType($userId);
    }

    public function userCanTransfer(int $userId): bool{
        if($this->getUserType($userId) !== 'common'){
            return false;
        }
        return true;
    }
}
