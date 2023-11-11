<?php

namespace Controllers;

use App\Http\Controllers\TransactionController;
use App\Models\User;
use App\Services\UserService;
use Tests\TestCase;

class TransactionControllerTest extends TestCase
{
    public $user_service;

    public function test__construct(UserService $user_service)
    {
        $this->user_service = $user_service;
    }

    public function testeUserIsRegistered() {
        $user = User::factory()->create();

        $retrieved_user = $this->user_service->getUserById($user->id);

        $this->assertEquals($retrieved_user->id, $user->id);
    }

    public function testUserCanTransfer() {
        $service = new UserService();
        $common_user = User::factory()->create(['user_type' => 'common']);
        $can_transfer = $service->userCanTransfer($common_user->id);

        $this->assertTrue($can_transfer);
    }

    public function testUserCantTransfer() {
        $service = new UserService();
        $seller_user = User::factory()->create(['user_type' => 'seller']);
        $can_transfer = $service->userCanTransfer($seller_user->id);

        $this->assertFalse($can_transfer);
    }
}
