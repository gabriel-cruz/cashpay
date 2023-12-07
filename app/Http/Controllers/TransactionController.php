<?php

namespace App\Http\Controllers;

use App\Exceptions\InsufficientFundsException;
use App\Exceptions\InvalidUserException;
use App\Exceptions\UnauthorizedTransferException;
use App\Exceptions\UnauthorizedUserException;
use App\Exceptions\WalletNotFindException;
use App\Models\User;
use App\Services\TransactionService;
use Illuminate\Http\Request;



class TransactionController
{
    public function __construct(
        public TransactionService $transaction
    ){}

    public function makeTransaction(Request $request)
    {

        try{
            $fields = $request->only(['value', 'sender', 'receiver']);
            return $this->transaction
                ->createTransaction($fields['sender'], $fields['receiver'], $fields['value']);

        } catch (InvalidUserException | UnauthorizedUserException | InsufficientFundsException |
                WalletNotFindException | UnauthorizedTransferException $exception) {
            return response()->json($exception->getMessage(), $exception->getCode());

        } catch(\Exception) {
            return response()
                ->json('Transação não realizada, tente novamente mais tarde.', 500);
        }
    }
}
