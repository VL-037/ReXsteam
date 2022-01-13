<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Friend;
use App\Models\FriendRequest;
use App\Models\Game;
use App\Models\GameOwner;
use App\Models\TransactionDetail;
use App\Models\TransactionHeader;
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
        if (Auth::user() && Auth::user()->role == "Member" && $cart == null) {
            $cart = Cart::create([
                'user_id' => Auth::user()->id
            ]);
        }
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
        return redirect('/');
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
        return redirect('/');
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
            $card = Card::create([
                'name' => $data['name'],
                'number' => $data['number'],
                'expiredDateM' => $data['expiredDateM'],
                'expiredDateY' => $data['expiredDateY'],
                'CVC_CVV' => $data['CVC_CVV'],
                'country' => $data['country'],
                'postalCode' => $data['postalCode']
            ]);

            $gameIds = CartItem::where('cart_id', $cart->id)->get('game_id');
            
            $games = Game::whereIn('id', $gameIds)->get();
            $totalPrice = 0;

            foreach ($games as $game) {
                $totalPrice += $game->price;
            }

            $transactionHeader = TransactionHeader::create([
                'cart_id' => $cart->id,
                'user_id' => $user->id,
                'card_id' => $card->id,
                'totalPrice' => $totalPrice
            ]);

            foreach ($games as $game) {
                TransactionDetail::create([
                    'transaction_header_id' => $transactionHeader->id,
                    'game_id' => $game->id
                ]);
            }
            
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
            return redirect('/cart')->with('success', 'Games Checked Out, +1 Level');
        }
        return redirect('/');
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
                    'urlPic' => 'mimes:jpg,png|max:800',
                );

                $validator = Validator::make($data, $rule);

                if($validator->fails()) {
                    return redirect('/profile')->with('error', 'Invalid input');
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
            $incomingFriendRequests = User::join('friend_request', 'from_user_id', '=', 'user.id')->where('to_user_id', $user->id)->where('from_user_id', '<>', $user->id)->get();
            $pendingFriendRequests = User::join('friend_request', 'to_user_id', '=', 'user.id')->where('from_user_id', $user->id)->where('to_user_id', '<>', $user->id)->get();
            
            $first = Friend::select('friend1_id')->where('friend2_id', $user->id);
            $second = Friend::select('friend2_id')->where('friend1_id', $user->id)->union($first)->get();
            $myFriends = User::whereIn('id', $second)->get();

            return view('users.friends')->with(['user' => $user, 'incomingFriendRequests' => $incomingFriendRequests, 'pendingFriendRequests' => $pendingFriendRequests, 'myFriends' => $myFriends]);

        }
        return redirect('/login');
    }

    public function addFriend(Request $request) {
        $user = Auth::user() ? User::where('id', Auth::user()->id)->first() : null;
        if ($user) {
            $toUsername = $request->username;
            $toUser = User::where('username', $toUsername)->first();

            if ($toUser == null) {
                return back()->with('error', 'Username not Found');
            }

            $requestIsExists = FriendRequest::where('from_user_id', $user->id)->where('to_user_id', $toUser->id)->first() ? true : false;

            if ($requestIsExists) {
                return back()->with('error', 'Friend Request Already Sent');
            }

            FriendRequest::create([
                'from_user_id' => $user->id,
                'to_user_id' => $toUser->id
            ]);
            return back()->with('success', 'Friend Request Sent');
        }
        return redirect('/');
    }

    public function acceptFriend($friendRequestId) {
        $user = Auth::user() ? User::where('id', Auth::user()->id)->first() : null;
        if ($user) {
            $newFriend = FriendRequest::where('id', $friendRequestId)->first('from_user_id');
            $newFriendUserId = $newFriend->from_user_id;
            
            Friend::create([
                'friend1_id' => $newFriendUserId,
                'friend2_id' => $user->id,
            ]);

            FriendRequest::destroy($friendRequestId);
            return back()->with('success', 'Request Accepted');
        }
        return redirect('/');
    }

    public function rejectFriend($friendRequestId) {
        $user = Auth::user() ? User::where('id', Auth::user()->id)->first() : null;
        if ($user) {
            FriendRequest::destroy($friendRequestId);
            return back()->with('success', 'Request Rejected');
        }
        return redirect('/');
    }

    public function cancelRequest($friendRequestId) {
        $user = Auth::user() ? User::where('id', Auth::user()->id)->first() : null;
        if ($user) {
            FriendRequest::destroy($friendRequestId);
            return back()->with('success', 'Request Canceled');
        }
        return redirect('/');
    }

    public function transactionHistory(){
        $user = Auth::user() ? User::where('id', Auth::user()->id)->first() : null;
        if ($user) {
            $cart = Cart::where('user_id', Auth::user()->id)->first();
            $transactionHeaders = TransactionHeader::where('user_id', $user->id)->get();
            $transactionHeaderIds = TransactionHeader::where('user_id', $user->id)->get('id');
            $transactionDetails = TransactionDetail::whereIn('transaction_header_id', $transactionHeaderIds)->get();
            $games = Game::join('transaction_detail', 'game_id', '=', 'game.id')->whereIn('transaction_detail.transaction_header_id', $transactionHeaderIds)->with('transactionDetails')->get();

            return view('users.transactionHistory')->with(['transactionHeaders' => $transactionHeaders, 'transactionDetails' => $transactionDetails, 'games' => $games]);
        }
        return redirect('/login');
    }
}
