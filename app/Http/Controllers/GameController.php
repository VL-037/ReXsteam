<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index(){
        $games = Game::inRandomOrder()->limit(8)->get();
        return view('home')->with(['games' => $games]);
    }

    public function search(Request $request){
        $games = Game::where('name', 'LIKE', '%'.$request->name.'%')->paginate();
        return view('home')->with(['games' => $games]);
    }
}
