<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('user')->insert([
            ['username' => 'admin1', 'fullname' => 'Admin 1', 'password' => Hash::make('admin1'), 'role' => 'Admin'],
            ['username' => 'admin2', 'fullname' => 'Admin 2', 'password' => Hash::make('admin2'), 'role' => 'Admin'],
            ['username' => 'vin', 'fullname' => 'Vincent Low', 'password' => Hash::make('vin'), 'role' => 'Member'],
            ['username' => 'jis', 'fullname' => 'Jiswa Jiswa', 'password' => Hash::make('jis'), 'role' => 'Member'],
        ]);
    }
}
