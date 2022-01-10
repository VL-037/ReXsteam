<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            ['username' => 'admin1', 'fullname' => 'Admin 1', 'email' => 'admin1@gmail.com', 'password' => 'admin1', 'role' => 'Admin'],
            ['username' => 'admin2', 'fullname' => 'Admin 2', 'email' => 'admin2@gmail.com', 'password' => 'admin2', 'role' => 'Admin'],
            ['username' => 'vin', 'fullname' => 'Vincent Low', 'email' => 'vincent@gmail.com', 'password' => 'vin', 'role' => 'Member'],
            ['username' => 'jis', 'fullname' => 'Jiswa Jiswa', 'email' => 'jiswa@gmail.com', 'password' => 'jis', 'role' => 'Member'],
        ]);
    }
}
