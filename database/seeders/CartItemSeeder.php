<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('cart_item')->insert([
            ['cart_id' => 1, 'game_id' => 1],
            ['cart_id' => 1, 'game_id' => 4],
        ]);
    }
}
