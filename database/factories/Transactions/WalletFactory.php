<?php

namespace Database\Factories\Transactions;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class WalletFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'amount' => rand(00.00, 999.00),
            'user_id' => User::factory()->create(['user_type' => 'common'])->id,
        ];
    }
}
