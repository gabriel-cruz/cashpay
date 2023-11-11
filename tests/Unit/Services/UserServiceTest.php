<?php

namespace Tests\Unit\Services;

use App\Models\User;
use App\Services\UserService;
use Tests\TestCase;

class UserServiceTest extends TestCase
{
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
