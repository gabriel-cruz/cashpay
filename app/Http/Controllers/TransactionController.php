<?php

namespace App\Http\Controllers;

use App\Exceptions\InsufficientFundsException;
use App\Exceptions\InvalidUserException;
use App\Exceptions\UnauthorizedTransferException;
use App\Exceptions\UnauthorizedUserException;
use App\Models\User;
use App\Services\TransactionService;
use Illuminate\Http\Request;



class TransactionController
{
    public $transaction;

    public function __construct(TransactionService $transaction){
        $this->transaction = $transaction;
    }

    public function makeTransaction(Request $request){
        try{
            $fields = $request->only(['value', 'sender', 'receiver']);
            dd($this->transaction->createTransaction($fields['sender'], $fields['receiver'], $fields['value']));
        } catch (InvalidUserException | UnauthorizedUserException | InsufficientFundsException | UnauthorizedTransferException $exception){
            return response()->json($exception->getMessage(), $exception->getCode());
        } catch(\Exception $exception){
            return response()->json('Transação não realizada, tente novamente mais tarde.', 500);
        }
    }
}
