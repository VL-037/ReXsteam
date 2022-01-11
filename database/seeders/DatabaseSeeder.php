<?php

namespace Database\Seeders;

use App\Models\CartItem;
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
        $this->call([
            CategorySeeder::class,
            GameSeeder::class,
            UserSeeder::class,
            GameOwnerSeeder::class,
            CartSeeder::class,
            CartItemSeeder::class,
            FriendSeeder::class
        ]);
    }
}
