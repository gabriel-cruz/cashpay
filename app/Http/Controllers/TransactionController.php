<?php

namespace App\Http\Controllers;

use App\Services\TransactionService;
use Illuminate\Http\Request;


class TransactionController
{
    public $transaction;

    public function __construct(TransactionService $transaction){
        $this->transaction = $transaction;
    }

    public function makeTransaction(Request $request){
        $fields = $request->only(['value', 'sender', 'receiver']); //tratar o erro caso os campos não estejam corretos

        return $this->transaction->createTransaction($fields['sender'], $fields['receiver'], $fields['value']);
    }
}
