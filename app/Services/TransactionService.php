<?php

namespace App\Services;

use App\Repositories\TransactionRepository;

class TransactionService
{
    public function createTransaction(int $sender, int $receiver, float $value){
        $user = new UserService();
        $wallet = new WalletService();
        $transaction = new TransactionRepository();

        //não gostei, quero mudar
        if(!$user->getUserById($sender) || !$user->getUserById($receiver)){
            //throw exception
            return response()->json("Usuário não encontrado", 404);
        }

        if(!$user->userCanTransfer($sender)){
            return response()->json("Usuário não autorizado para transferência", 401); //throw exception
        }

        if(!$wallet->checkUserAmount($sender, $value)){
            return response()->json("Usuário não tem o valor suficiente para transferência", 404);
        }
        //TODO: Request de validação

        if($transaction->saveTransaction($sender, $receiver, $value)){
            //TODO: Request de notificação

            return response()->json("Transferência realizada com sucesso");
        }
    }
}
