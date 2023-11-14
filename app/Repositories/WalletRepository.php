<?php

namespace App\Repositories;

use App\Exceptions\WalletNotFindException;
use App\Models\Transactions\Wallet;
use Illuminate\Support\Facades\DB;

class WalletRepository
{
    public function getAmount(int $userId): float{
        $result = DB::table('wallets')->where('user_id', $userId)->value('amount');

        if(is_null($result)){
            throw new WalletNotFindException('O usuário não tem carteira', 404);
        }
        return $result;
    }

    public function deposit(int $userId, $value){
        $newValue = $this->getAmount($userId) + $value;

        DB::table('wallets')->where('user_id', $userId)->update(['amount' => $newValue]);
    }

    public function subtract(int $userId, $value){
        $newValue = $this->getAmount($userId) - $value;

        DB::table('wallets')->where('user_id', $userId)->update(['amount' => $newValue]);
    }
}
