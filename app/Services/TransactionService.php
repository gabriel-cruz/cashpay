<?php

namespace App\Services;

use App\Exceptions\InsufficientFundsException;
use App\Exceptions\InvalidUserException;
use App\Exceptions\UnauthorizedTransferException;
use App\Exceptions\UnauthorizedUserException;
use App\Repositories\TransactionRepository;

class TransactionService
{

    public function __construct(
        public UserService           $user,
        public WalletService         $wallet,
        public TransactionRepository $transaction,
        public AuthorizeRepository   $authorization,
        public NotificationRepository $notification
    ){}

    public function createTransaction(int $sender, int $receiver, float $value){
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

        $this->transaction->saveTransaction($sender, $receiver, $value);

        if($this->notification->notifyUser()->getStatusCode() !== 200){
            return response()->json("Transferência realizada, mas o serviço de notificações está fora do ar");
        }
        return response()->json("Transferência realizada com sucesso");

    }
}
