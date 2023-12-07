<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class TransactionRepository
{
    public function __construct(
        public WalletRepository $wallet
    ){}

    public function saveTransaction(int $sender, int $receiver, float $value)
    {
        $this->wallet->deposit($receiver, $value);
        $this->wallet->subtract($sender, $value);

        $result = DB::table('transactions')->insert([
            'sender' => $sender,
            'receiver' => $receiver,
            'amount' => $value
        ]);
        return $result;
    }
}
