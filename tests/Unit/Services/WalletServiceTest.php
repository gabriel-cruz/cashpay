<?php

namespace Services;

use App\Exceptions\WalletNotFindException;
use App\Models\Transactions\Wallet;
use App\Repositories\WalletRepository;
use App\Services\WalletService;
use Tests\TestCase;

class WalletServiceTest extends TestCase
{
    public function testUserHasSuffienctFunds(){
        $user = Wallet::factory()->create(['amount' => 50.00]);
        $wallet = new WalletService();

        $this->assertTrue($wallet->checkUserAmount($user->user_id, 30.00));
    }

    public function testUserWithInsuffienctFunds(){
        $user = Wallet::factory()->create(['amount' => 20.00]);
        $wallet = new WalletService();

        $this->assertFalse($wallet->checkUserAmount($user->user_id, 30.00));
    }

    public function testExceptionIsThrownWhenWalletNotFound(){
        $wallet = new WalletRepository();

        $this->expectException(WalletNotFindException::class);

        $wallet->getAmount(9999);
    }
}
