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
        DB::table('game')->insert([
            ['name' => 'Resident Evil Village', 'description_short' => 'short desc', 'description_long' => 'longggggggggggggggggggggggg descccccccccccccccccccc', 'category_id' => 1, 'developer' => 'Capcom', 'publisher' => 'asdf', 'price' => 1000, 'cover' => 'https://image.shutterstock.com/image-vector/futuristic-black-red-gaming-banner-260nw-1940014285.jpg', 'trailer' => 'https://dl8.webmfiles.org/big-buck-bunny_trailer.webm', 'onlyAdult' => true],
            ['name' => 'Death Loop', 'description_short' => 'short desc', 'description_long' => 'longggggggggggggggggggggggg descccccccccccccccccccc', 'category_id' => 3, 'developer' => 'Arkane Studios', 'publisher' => 'Betheseda Softworks', 'price' => 2000, 'cover' => 'https://image.shutterstock.com/image-vector/futuristic-black-red-gaming-banner-260nw-1940014285.jpg', 'trailer' => 'https://dl8.webmfiles.org/big-buck-bunny_trailer.webm', 'onlyAdult' => false],
            ['name' => 'Halo Infinite', 'description_short' => 'short desc', 'description_long' => 'longggggggggggggggggggggggg descccccccccccccccccccc', 'category_id' => 2, 'developer' => '343 industries', 'publisher' => 'Xbox Game Studios', 'price' => 3000, 'cover' => 'https://image.shutterstock.com/image-vector/futuristic-black-red-gaming-banner-260nw-1940014285.jpg', 'trailer' => 'https://dl8.webmfiles.org/big-buck-bunny_trailer.webm', 'onlyAdult' => false],
            ['name' => 'It Takes Two', 'description_short' => 'short desc', 'description_long' => 'longggggggggggggggggggggggg descccccccccccccccccccc', 'category_id' => 5, 'developer' => 'Hazelight Studios, Hazelight', 'publisher' => 'EA Originals', 'price' => 4000, 'cover' => 'https://image.shutterstock.com/image-vector/futuristic-black-red-gaming-banner-260nw-1940014285.jpg', 'trailer' => 'https://dl8.webmfiles.org/big-buck-bunny_trailer.webm', 'onlyAdult' => false],
            ['name' => 'Mass Effect 2', 'description_short' => 'short desc', 'description_long' => 'longggggggggggggggggggggggg descccccccccccccccccccc', 'category_id' => 3, 'developer' => 'Bioware', 'publisher' => 'Electronic Arts', 'price' => 5000, 'cover' => 'https://image.shutterstock.com/image-vector/futuristic-black-red-gaming-banner-260nw-1940014285.jpg', 'trailer' => 'https://dl8.webmfiles.org/big-buck-bunny_trailer.webm', 'onlyAdult' => false],
            ['name' => 'Super Mario Galaxy 2', 'description_short' => 'short desc', 'description_long' => 'longggggggggggggggggggggggg descccccccccccccccccccc', 'category_id' => 6, 'developer' => 'Nintendo', 'publisher' => 'Nintendo', 'price' => 6000, 'cover' => 'https://image.shutterstock.com/image-vector/futuristic-black-red-gaming-banner-260nw-1940014285.jpg', 'trailer' => 'https://dl8.webmfiles.org/big-buck-bunny_trailer.webm', 'onlyAdult' => false],
            ['name' => 'LIMBO', 'description_short' => 'short desc', 'description_long' => 'longggggggggggggggggggggggg descccccccccccccccccccc', 'category_id' => 2, 'developer' => 'Playdead', 'publisher' => 'Microsoft Games', 'price' => 7000, 'cover' => 'https://image.shutterstock.com/image-vector/futuristic-black-red-gaming-banner-260nw-1940014285.jpg', 'trailer' => 'https://dl8.webmfiles.org/big-buck-bunny_trailer.webm', 'onlyAdult' => false],
            ['name' => 'Alan Wake', 'description_short' => 'short desc', 'description_long' => 'longggggggggggggggggggggggg descccccccccccccccccccc', 'category_id' => 4, 'developer' => 'Remedy Entertaiment', 'publisher' => 'Remedy Entertaiment, Epic Games', 'price' => 8000, 'cover' => 'https://image.shutterstock.com/image-vector/futuristic-black-red-gaming-banner-260nw-1940014285.jpg', 'trailer' => 'https://dl8.webmfiles.org/big-buck-bunny_trailer.webm', 'onlyAdult' => false],
        ]);
    }
}
