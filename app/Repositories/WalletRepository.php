<?php

namespace App\Repositories;

use App\Exceptions\WalletNotFindException;
use App\Models\Transactions\Wallet;
use Illuminate\Support\Facades\DB;

class WalletRepository
{
    public function getAmount(int $user_id): float{
        $result = DB::table('wallets')->where('user_id', $user_id)->value('amount');

        if(is_null($result)){
            throw new WalletNotFindException('O usuário não tem carteira', 404);
        }
        return $result;
    }

    public function deposit(int $user_id, $value){
        $newValue = $this->getAmount($user_id) + $value;

        DB::table('wallets')->where('user_id', $user_id)->update(['amount' => $newValue]);
    }

    public function subtract(int $user_id, $value){
        $newValue = $this->getAmount($user_id) - $value;

        DB::table('wallets')->where('user_id', $user_id)->update(['amount' => $newValue]);
    }
}
