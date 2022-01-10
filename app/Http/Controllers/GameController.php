<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\GameOwner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    public function index(){
        $games = Game::inRandomOrder()->limit(8)->get();
        return view('home')->with(['games' => $games]);
    }

    public function detail($gameId){
        $game = Game::where('id', $gameId)->first();
        $isOwned = GameOwner::where('user_id', Auth::user()->id)->where('game_id', $gameId)->first() ? true : false;
        return view('detail')->with(['game' => $game])->with(['isOwned' => $isOwned]);
    }

    public function search(Request $request){
        $games = Game::where('name', 'LIKE', '%'.$request->name.'%')->paginate(8);
        return view('search')->with(['games' => $games]);
    }
}
