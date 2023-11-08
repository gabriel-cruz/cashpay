<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class WalletRepository
{
    public function getAmount(int $user_id): float{
        return DB::table('wallet')->where('user_id', $user_id)->value('amount');
    }
}
