<?php

namespace App\Services;

use App\Exceptions\InsufficientFundsException;
use App\Exceptions\InvalidUserException;
use App\Exceptions\UnauthorizedTransferException;
use App\Exceptions\UnauthorizedUserException;
use App\Repositories\TransactionRepository;

class TransactionService
{
    public $user;
    public $wallet;
    public $transaction;
    public $authorization;

    public function __construct(UserService $user, WalletService $wallet, TransactionRepository $transaction, AuthorizeService $authorization){
        $this->user = $user;
        $this->wallet = $wallet;
        $this->transaction = $transaction;
        $this->authorization = $authorization;
    }

    public function createTransaction(int $sender, int $receiver, float $value){
        //não gostei, quero mudar
        if(!$this->user->getUserById($sender) || !$this->user->getUserById($receiver)){
            throw new InvalidUserException("Usuário não encontrado", 404);
        }

        if(!$this->user->userCanTransfer($sender)){
            throw new UnauthorizedUserException("Usuário não autorizado para transferência", 401);
        }

        if(!$this->wallet->checkUserAmount($sender, $value)){
            throw new InsufficientFundsException("Usuário não tem o valor suficiente para transferência", 403);
        }

        if($this->authorization->authorizeTransaction()->getStatusCode() !== 200){
            throw new UnauthorizedTransferException("Transferência não autorizada", 401);
        }

        if($this->transaction->saveTransaction($sender, $receiver, $value)){
            //TODO: Request de notificação

            return response()->json("Transferência realizada com sucesso");
        }
    }
}
