<?php

namespace Services;

use App\Models\Transactions\Wallet;
use App\Repositories\TransactionRepository;
use App\Repositories\WalletRepository;
use Tests\TestCase;

class TransactionTest extends TestCase
{
    public function testIfDepositIsMade(){
        $repository = new WalletRepository();
        $receiver = Wallet::factory()->create(['amount' => 50.00]);

        $repository->deposit($receiver->user_id, 10.00);
        $this->assertEquals(60, $repository->getAmount($receiver->user_id));
    }

    public function testIfWithdrawIsMade(){
        $repository = new WalletRepository();
        $sender = Wallet::factory()->create(['amount' => 50.00]);

        $repository->subtract($sender->user_id, 10.00);
        $this->assertEquals(40, $repository->getAmount($sender->user_id));
    }

    public function testSaveTransaction(){
        $receiver = Wallet::factory()->create();
        $sender = Wallet::factory()->create();
        $repository = new TransactionRepository();

        $this->assertTrue($repository->saveTransaction($receiver->user_id, $sender->user_id, 1.00));
    }
}
