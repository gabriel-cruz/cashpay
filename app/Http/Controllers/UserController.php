<?php

namespace App\Http\Controllers;

use App\Services\UserService;
use Illuminate\Http\Request;
use App\Repositories\UserRepository;

class UserController extends Controller
{
    public function getUser(){
        $user = new UserService();

        dd($user->getUserType(1));
    }
}
