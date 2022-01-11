<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Game;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function gameIndex() {
        $categories = Category::all();
        $games = Game::paginate(8);
        return view('users.admins.manageGame')->with(['categories' => $categories, 'games' => $games]);
    }

    public function gameUpdateForm() {
        return view('users.admins.updateGame');
    }

    public function gameDestroy($gameId) {
        Game::destroy($gameId);
        return redirect('/admin/games');
    }

    public function filterSearch(Request $request) {
        $categories = Category::all();
        $games = Game::where('name', 'LIKE', '%'.$request->name.'%')->paginate(8);
        if ($request->categories != null){
            $games = Game::where('name', 'LIKE', '%'.$request->name.'%')->whereIn('category_id', $request->categories)->paginate(8);
        }
        return view('users.admins.searchGame')->with(['games' => $games, 'categories' => $categories]);
    }
}
