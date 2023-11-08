<?php

namespace App\Services;

use App\Repositories\UserRepository;

class UserService
{
    public function getUserById(int $user_id){
        $repository = new UserRepository();

        return $repository->findUserById($user_id);
    }

    public function getUserType(int $user_id): string{
        $repository = new UserRepository();

        return $repository->getUserType($user_id);
    }

    public function userCanTransfer(int $user_id): bool{
        if($this->getUserType($user_id) !== 'common'){
            return false;
        }
        return true;
    }
}
