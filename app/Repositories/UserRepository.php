<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserRepository
{
    public function findUserById(int $userId){
        return DB::table('users')->find($userId);
    }

    public function getUserType(int $userId): string{
         return DB::table('users')->where('id', $userId)->value('user_type');
    }
}
