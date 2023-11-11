<?php

namespace App\Services;

use App\Exceptions\WalletNotFindException;
use App\Repositories\WalletRepository;

class WalletService
{
    public function getAmount(int $user_id): float{
        $wallet = new WalletRepository();

        return $wallet->getAmount($user_id);
    }

    public function checkUserAmount(int $user_id, float $value): bool{
        try{
            if($this->getAmount($user_id) < $value){
                return false;
            }
            return true;
        }catch (WalletNotFindException $exception){
            return false;
        }
    }
}
