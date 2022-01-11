<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function cart() {
        $cart = Auth::user() ? Cart::where('user_id', Auth::user()->id)->first() : null;
        if($cart) {
            $games = Game::join('cart_item', 'game_id', '=', 'game.id')->where(['cart_item.cart_id' => $cart->id])->with('cartItems')->get();
            return view('users.cart')->with(['games' => $games]);
        }
        return view('users.login');
    }

    public function destroyCartItem($cartItemId) {
        CartItem::destroy($cartItemId);
        return redirect('/cart');
    }

    public function transactionIndex() {
        $cart = Auth::user() ? Cart::where('user_id', Auth::user()->id)->first() : null;
        if($cart) {
            $games = Game::join('cart_item', 'game_id', '=', 'game.id')->where(['cart_item.cart_id' => $cart->id])->with('cartItems')->get();
            $totalPrice = 0;
            if (count($games) > 0) {
                foreach ($games as $game) {
                    $totalPrice += $game->price;
                }
                return view('users.transaction')->with(['totalPrice' => $totalPrice]);
            }
            return back();
        }
        return view('users.login');
    }

    public function checkout() {
        $cart = Auth::user() ? Cart::where('user_id', Auth::user()->id)->first() : null;
        if($cart) {
            $games = Game::join('cart_item', 'game_id', '=', 'game.id')->where(['cart_item.cart_id' => $cart->id])->with('cartItems')->get();
            $totalPrice = 0;
            if (count($games) > 0) {
                foreach ($games as $game) {
                    $totalPrice += $game->price;
                }
                return back();
            }
            return back();
        }
        return view('users.login');
    }
}
