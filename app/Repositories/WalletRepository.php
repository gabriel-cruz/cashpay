<?php

namespace App\Repositories;

use App\Models\Transactions\Wallet;
use Illuminate\Support\Facades\DB;

class WalletRepository
{
    public function getAmount(int $user_id): float{
        return DB::table('wallet')->where('user_id', $user_id)->value('amount');
    }

    public function deposit(int $user_id, $value){
        $newValue = $this->getAmount($user_id) + $value;

        DB::table('wallet')->where('user_id', $user_id)->update(['amount' => $newValue]);
    }

    public function subtract(int $user_id, $value){
        $newValue = $this->getAmount($user_id) - $value;

        DB::table('wallet')->where('user_id', $user_id)->update(['amount' => $newValue]);
    }
}
