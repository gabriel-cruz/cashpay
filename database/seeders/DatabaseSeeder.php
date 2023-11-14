<?php

namespace Database\Seeders;

use App\Models\Transactions\Wallet;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Wallet::factory()->count(20)->create();
    }
}
