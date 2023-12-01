<?php

namespace App\Services;

use App\Exceptions\WalletNotFindException;
use App\Repositories\WalletRepository;

class WalletService
{
    public function __construct(
        public WalletRepository $wallet
    ){}

    public function getAmount(int $userId): float{
        return $this->wallet->getAmount($userId);
    }

    public function checkUserAmount(int $userId, float $value): bool{
        try{
            if($this->getAmount($userId) < $value){
                return false;
            }
            return true;
        }catch (WalletNotFindException){
            return false;
        }
    }
}
