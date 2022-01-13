<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Friend;
use App\Models\Game;
use App\Models\GameOwner;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function cart() {
        $cart = Auth::user() ? Cart::where('user_id', Auth::user()->id)->first() : null;
        if($cart) {
            $games = Game::join('cart_item', 'game_id', '=', 'game.id')->where(['cart_item.cart_id' => $cart->id])->with('cartItems')->get();
            $totalPrice = 0;
            if (count($games) > 0) {
                foreach ($games as $game) {
                    $totalPrice += $game->price;
                }
            }
            return view('users.cart')->with(['games' => $games, 'totalPrice' => $totalPrice]);
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

    public function checkout(Request $request) {
        $cart = Auth::user() ? Cart::where('user_id', Auth::user()->id)->first() : null;
        if($cart) {
            $data = $request->except(array('_token'));
            $rule = array(
                'name' =>'required|min:6',
                'number' =>'required|numeric',
                'expiredDateM' =>'required|numeric|min:1|max:12',
                'expiredDateY' => 'required|numeric|min:2021|max:2050',
                'CVC_CVV' => 'required|digits_between:3,4',
                'country' => 'required',
                'postalCode' => 'required|numeric'
            );

            $validator = Validator::make($data, $rule);

            if($validator->fails()) {
                return redirect('/cart/transaction')->with('error', 'Invalid input');
            }
            
            $user = Auth::user();
            Card::create([
                'name' => $data['name'],
                'number' => $data['number'],
                'expiredDateM' => $data['expiredDateM'],
                'expiredDateY' => $data['expiredDateY'],
                'CVC_CVV' => $data['CVC_CVV'],
                'country' => $data['country'],
                'postalCode' => $data['postalCode'],
                'user_id' => $user->id
            ]);
            
            User::where('id', $user->id)->update([
                'level' => $user->level+=1
            ]);
            
            $gameIds = CartItem::where('cart_id', $cart->id)->get('game_id');
            for ($i=0 ; $i<count($gameIds) ; $i++) {
                GameOwner::create([
                    'user_id' => $user->id,
                    'game_id' => $gameIds[$i]->game_id
                ]);
            }

            CartItem::where('cart_id', $cart->id)->delete();
            return redirect('/cart');
        }
        return view('users.login');
    }

    public function profile() {
        $user = Auth::user() ? User::where('id', Auth::user()->id)->first() : null;
        if ($user) {
            return view('users.profile')->with(['user' => $user]);
        }
        return redirect('/login');
    }

    public function updateProfile(Request $request) {
        $user = Auth::user() ? User::where('id', Auth::user()->id)->first() : null;
        if ($user) {
            $newPassword = $request->newPassword;
            $confNewPassword = $request->confNewPassword;
            if (Hash::check($request->currPassword, $user->password)) {
                if ($newPassword && $confNewPassword) {
                    if ($newPassword == $confNewPassword){
                        User::where('id', $user->id)->update([
                            'password' => Hash::make($newPassword)
                        ]);
                    }
                }

                $data = $request->except(array('_token'));
                $rule = array(
                    'urlPic' => 'required|mimes:jpg,png|max:800',
                );

                $validator = Validator::make($data, $rule);

                if($validator->fails()) {
                    return redirect('/admin/games/'.$request->id.'/update')->with('error', 'Invalid input');
                }
                
                if ($request->hasFile('urlPic') == true) {
                    Storage::disk('public')->put('images', $request->urlPic);
                    User::where('id', $user->id)->update([
                        'fullname' => $request->fullname,
                        'urlPic' => '/uploads/images/'.$request->urlPic->hashName()
                    ]);
                } else {
                    User::where('id', $user->id)->update([
                        'fullname' => $request->fullname,
                    ]);
                }
                return redirect('/profile')->with(['user' => $user, 'success' => 'Profile Updated']);
            }
            return redirect('/profile')->with(['user' => $user, 'error' => 'Update Failed']);
        }
        return redirect('/login');
    }

    public function friends() {
        $user = Auth::user() ? User::where('id', Auth::user()->id)->first() : null;
        if ($user) {
            $friend1Ids = Friend::where('friend2_id', $user->id)->get('friend1_id');
            $friend2Ids = Friend::where('friend1_id', $user->id)->get('friend2_id');

            return view('users.friends');

        }
        return redirect('/login');
    }

    public function transactionHistory(){
        $user = Auth::user() ? User::where('id', Auth::user()->id)->first() : null;
        if ($user) {

          
            
            return view('users.transactionHistory')->with('user', $user);
            

        }
        return redirect('/login');
    }
}
