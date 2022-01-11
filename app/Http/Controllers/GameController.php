<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Game;
use App\Models\GameOwner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    public function index(){
        $games = Game::inRandomOrder()->limit(8)->get();
        return view('games.home')->with(['games' => $games]);
    }

    public function detail($gameId){
        $game = Game::where('id', $gameId)->first();
        $isOwned = Auth::user() ? (GameOwner::where('user_id', Auth::user()->id)->where('game_id', $gameId)->first() ? true : false) : false;
        return view('games.detail')->with(['game' => $game])->with(['isOwned' => $isOwned]);
    }

    public function newForm() {
        $categories = Category::all();
        return view('users.admins.createGame')->with(['categories' => $categories]);
    }

    public function new(Request $request) {
        $data = $request->validate([
            'name' =>'required',
            'description_short' =>'required',
            'description_long' =>'required',
            'category' => 'required',
            'developer' => 'required',
            'publisher' => 'required',
            'price' => 'required',
            // 'cover' => 'required',
            // 'trailer' => 'required',
        ]);

        Game::create([
            'name' => $data['name'],
            'description_long' => $data['description_long'],
            'description_short' => $data['description_short'],
            'category_id' => $data['category'],
            'developer' => $data['developer'],
            'publisher' => $data['publisher'],
            'price' => $data['price'],
            'cover' => $request->cover ? $data['cover'] : "https://mobitekno.com/wp-content/uploads/2017/12/20171108094330_Review_Cover_Fire__Game_Action_Untuk_Fans_Militer_Modern-768x432.jpg",
            'trailer' => $request->trailer ? $data['trailer'] : "https://www.bigbuckbunny.org/",
            'onlyAdult' => $request->isAdult ? true : false,
        ]);

        return redirect('/admin/games')->with('success', 'Successfully Created A New Game');
    }

    public function updateForm($gameId) {
        $categories = Category::all();
        $game = Game::where('id', $gameId)->first();
        return view('users.admins.updateGame')->with(['game' => $game, 'categories' => $categories]);
    }

    public function update(Request $request) {
        $data = $request->validate([
            'description_short' =>'required',
            'description_long' =>'required',
            'category' => 'required',
            'price' => 'required',
            // 'cover' => 'required',
            // 'trailer' => 'required',
        ]);

        Game::where('id', $request->id)->update([
            'description_long' => $data['description_long'],
            'description_short' => $data['description_short'],
            'category_id' => $data['category'],
            'price' => $data['price'],
            'cover' => $request->cover ? $data['cover'] : "https://mobitekno.com/wp-content/uploads/2017/12/20171108094330_Review_Cover_Fire__Game_Action_Untuk_Fans_Militer_Modern-768x432.jpg",
            'trailer' => $request->trailer ? $data['trailer'] : "https://www.bigbuckbunny.org/",
        ]);

        return redirect('/admin/games')->with('success', 'Successfully Update Game');
    }

    public function destroy($gameId) {
        Game::destroy($gameId);
        return redirect('/admin/games');
    }

    public function search(Request $request){
        $games = Game::where('name', 'LIKE', '%'.$request->name.'%')->paginate(8);
        return view('games.search')->with(['games' => $games]);
    }
}
