<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Category;
use App\Models\Game;
use App\Models\GameOwner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class GameController extends Controller
{
    public function index(){
        $games = Game::inRandomOrder()->paginate(8);
        return view('games.home')->with(['games' => $games]);
    }

    public function detail($gameId){
        $game = Game::where('id', $gameId)->first();

        if($game->onlyAdult) {
            return redirect('/games/'.$gameId.'/checkAge')->with(['game', $game]);
        }

        $isOwned = Auth::user() ? (GameOwner::where('user_id', Auth::user()->id)->where('game_id', $gameId)->first() ? true : false) : false;
        return view('games.detail')->with(['game' => $game])->with(['isOwned' => $isOwned]);
    }

    public function addToCart($gameId) {
        $cart = Auth::user() ? Cart::where('user_id', Auth::user()->id)->first() : null;
        if ($cart) {
            $isInCart = Game::join('cart_item', 'game_id', '=', 'game.id')->where(['cart_item.cart_id' => $cart->id])->whereIn('cart_item.game_id', array($gameId))->with('cartItems')->get();

            if(count($isInCart) > 0) {
                return redirect('/games/'.$gameId.'/')->with('error', 'Game is already in cart');
            }
            CartItem::create([
                'cart_id' => $cart->id,
                'game_id' => $gameId
            ]);
            return redirect('/games/'.$gameId.'/')->with('success', 'Game added to cart');
        }
        return redirect('/login');
    }

    public function newForm() {
        $categories = Category::all();
        return view('users.admins.createGame')->with(['categories' => $categories]);
    }

    public function new(Request $request) {
        $data = $request->except(array('_token'));
        $rule = array(
            'name' =>'required|unique:game',
            'description_short' =>'required|max:500',
            'description_long' =>'required|max:2000',
            'category' => 'required',
            'developer' => 'required',
            'publisher' => 'required',
            'price' => 'required|numeric|min:1|max:1000000',
            // 'cover' => 'required|mimes:jpg|max:100',
            // 'trailer' => 'required|mimes:webm|max:102400',
        );

        $validator = Validator::make($data, $rule);

        if($validator->fails()) {
            return redirect('/admin/games/new')->with('error', 'Invalid input');
        }

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
        $data = $request->except(array('_token'));
        $rule = array(
            'description_short' =>'required|max:500',
            'description_long' =>'required|max:2000',
            'category' => 'required',
            'price' => 'required|numeric|min:1|max:1000000',
            'cover' => 'required|mimes:jpg,png|max:800',
            'trailer' => 'required|mimes:webm|max:102400',
        );

        $validator = Validator::make($data, $rule);

        if($validator->fails()) {
            return redirect('/admin/games/'.$request->id.'/update')->with('error', 'Invalid input');
        }
        
        Storage::disk('public')->put('images', $request->cover);
        Storage::disk('public')->put('videos', $request->trailer);

        Game::where('id', $request->id)->update([
            'description_long' => $data['description_long'],
            'description_short' => $data['description_short'],
            'category_id' => $data['category'],
            'price' => $data['price'],
            'cover' => '/uploads/images/'.$request->cover->hashName(),
            'trailer' => '/uploads/videos/'.$request->trailer->hashName(),
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
