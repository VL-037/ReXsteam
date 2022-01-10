<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GameOwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('game_owner')->insert([
            ['user_id' => 3, 'game_id' => 6],
            ['user_id' => 3, 'game_id' => 3],
            ['user_id' => 3, 'game_id' => 2]
        ]);
    }
}
