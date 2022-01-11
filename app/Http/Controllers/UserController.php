<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function cart() {
        $cart = Auth::user() ? Cart::where('user_id', Auth::user()->id)->first() : null;
        if($cart) {
            $games = Game::join('cart_item', 'game_id', '=', 'game.id')->with('cartItems')->get();
            return view('users.cart')->with(['games' => $games]);
        }
        return view('users.login');
    }

    public function destroyCartItem($cartItemId) {
        CartItem::destroy($cartItemId);
        return redirect('/cart');
    }
}
