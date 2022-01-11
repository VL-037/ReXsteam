<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FriendSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('friend')->insert([
            ['friend1_id' => 1, 'friend2_id' => 2],
            ['friend1_id' => 3, 'friend2_id' => 1],
            ['friend1_id' => 3, 'friend2_id' => 4],
        ]);
    }
}
