<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserRepository
{
    public function findUserById(int $id){
        return DB::table('users')->find($id);
    }

    /*public function findUserByDocument(string $document_id){
        return DB::table('users')->where('document_id', $document_id)->get();
    }*/

    public function getUserType(int $id): string{
         return DB::table('users')->where('id', $id)->value('user_type');
    }
}
