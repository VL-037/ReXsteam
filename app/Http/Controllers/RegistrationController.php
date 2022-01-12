<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class RegistrationController extends Controller
{
    public function index() {
        return view('users.register');
    }

    public function store(Request $request){
        $data = $request->except(array('_token'));
        $rule = array(
            'username' =>'required|min:6|unique:user',
            'fullname' =>'required',
            'password' =>'required|min:6|alpha_num',
            'role' => 'required'
        );

        $validator = Validator::make($data, $rule);

        if($validator->fails()) {
            return redirect('/register')->with('error', 'Invalid input');
        }

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
