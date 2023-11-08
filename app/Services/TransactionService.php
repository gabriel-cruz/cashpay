<?php

namespace App\Services;

class TransactionService
{
    public function createTransaction(int $sender, int $receiver, float $value){
        $user = new UserService();
        $wallet = new WalletService();

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

        return "Transferido com sucesso.";
    }
}
