<?php

namespace Controllers;

use App\Exceptions\InsufficientFundsException;
use App\Exceptions\InvalidUserException;
use App\Exceptions\UnauthorizedUserException;
use App\Exceptions\WalletNotFindException;
use App\Http\Controllers\TransactionController;
use App\Models\Transactions\Wallet;
use App\Models\User;
use App\Repositories\TransactionRepository;
use App\Repositories\WalletRepository;
use App\Services\TransactionService;
use App\Services\UserService;
use App\Services\WalletService;
use GuzzleHttp\Client;
use Tests\TestCase;

class TransactionControllerTest extends TestCase
{
    public $user_service;

    public function test__construct(UserService $user_service)
    {
        $this->user_service = $user_service;
    }

    public function testTrasactionisSuccesseful(){
        $sender = Wallet::factory()->create(['amount' => 50.00]);
        $receiver = User::factory()->create(['user_type' => 'seller']);

        $payload = [
            'value' => 30.00,
            'sender' => $sender->user_id,
            'receiver' => $receiver->id,
        ];

        $request = $this->post(route('transactions'), $payload);
        $request->assertStatus(200);
    }

    public function testInvalidUserException(){
        $payload = [
            'value' => 30.00,
            'sender' => 9999,
            'receiver' => 1,
        ];

        $request = $this->post(route('transactions'), $payload);
        $request->assertStatus(404);
    }

    public function testUnauthorizedUserException(){
        $seller = User::factory()->create(['user_type' => 'seller']);
        $receiver = Wallet::factory()->create();

        $payload = [
            'value' => 30.00,
            'sender' => $seller->id,
            'receiver' => $receiver->user_id,
        ];

        $request = $this->post(route('transactions'), $payload);
        $request->assertStatus(401);
    }

    public function testInsufficientFundsException(){
        $sender = Wallet::factory()->create(['amount' => 50.00]);
        $receiver = User::factory()->create(['user_type' => 'seller']);

        $payload = [
            'value' => 60.00,
            'sender' => $sender->user_id,
            'receiver' => $receiver->id,
        ];

        $request = $this->post(route('transactions'), $payload);
        $request->assertStatus(403);
    }
}
