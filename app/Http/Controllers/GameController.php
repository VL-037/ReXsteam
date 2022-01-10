<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index(){
        $games = Game::inRandomOrder()->limit(8)->get();

        return dd($games);
    }
}
