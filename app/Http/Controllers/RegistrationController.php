<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\Console\Input\Input;

class RegistrationController extends Controller
{
    public function index() {
        return view('users.register');
    }

    public function store(Request $request){
        $this->validate($request, [
            'username' =>'required|min:6|max:255|unique:user',
            'fullname' =>'required',
            'password' =>'required|min:6|alpha_num',
            'role' => 'required'
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($data['password']);

        $user = User::create([
            'username' => $data['username'],
            'fullname' => $data['fullname'],
            'password' => $data['password'],
            'role' => $data['role']
        ]);

        Cart::create([
            'user_id' => $user->id
        ]);
        
        Auth::login($user);
        return redirect('/')->with('success', 'Successfully Registered, Welcome to ReXsteam');
    }
}
