<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class TransactionRepository
{

    public function saveTransaction(int $sender, int $receiver, float $value){
        $wallet = new WalletRepository();

        $wallet->deposit($receiver, $value);
        $wallet->subtract($sender, $value);

        $result = DB::table('transactions')->insert([
            'sender' => $sender,
            'receiver' => $receiver,
            'amount' => $value
        ]);
        return $result;
    }
}
