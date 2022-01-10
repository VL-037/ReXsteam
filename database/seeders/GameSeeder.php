<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('games')->insert([
            ['name' => 'Resident Evil Village', 'description_short' => 'short desc', 'description_long' => 'longggggggggggggggggggggggg descccccccccccccccccccc', 'category_id' => 1, 'developer' => 'Capcom', 'publisher' => 'asdf', 'price' => 1000, 'cover' => 'link image mungkin', 'trailer' => 'link video mungkin', 'onlyAdult' => true],
            ['name' => 'Death Loop', 'description_short' => 'short desc', 'description_long' => 'longggggggggggggggggggggggg descccccccccccccccccccc', 'category_id' => 3, 'developer' => 'Arkane Studios', 'publisher' => 'Betheseda Softworks', 'price' => 2000, 'cover' => 'link image mungkin', 'trailer' => 'link video mungkin', 'onlyAdult' => false],
            ['name' => 'Halo Infinite', 'description_short' => 'short desc', 'description_long' => 'longggggggggggggggggggggggg descccccccccccccccccccc', 'category_id' => 2, 'developer' => '343 industries', 'publisher' => 'Xbox Game Studios', 'price' => 3000, 'cover' => 'link image mungkin', 'trailer' => 'link video mungkin', 'onlyAdult' => false],
            ['name' => 'It Takes Two', 'description_short' => 'short desc', 'description_long' => 'longggggggggggggggggggggggg descccccccccccccccccccc', 'category_id' => 5, 'developer' => 'Hazelight Studios, Hazelight', 'publisher' => 'EA Originals', 'price' => 4000, 'cover' => 'link image mungkin', 'trailer' => 'link video mungkin', 'onlyAdult' => false],
        ]);
    }
}
