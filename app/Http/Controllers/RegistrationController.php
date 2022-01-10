<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\Console\Input\Input;

class RegistrationController extends Controller
{
    public function index() {
        return view('register');
    }

    public function store(Request $request){
        $this->validate($request, [
            'username' =>'required|min:6|max:255|unique:users',
            'fullname' =>'required',
            'password' =>'required|min:6|alpha_num',
            'role' => 'required'
        ]);

        $data = $request->all();

        $user = User::create([
            'username' => $data['username'],
            'fullname' => $data['fullname'],
            'password' => $data['password'],
            'role' => $data['role']
        ]);
        
        Auth::login($user);
        return redirect('/')->with('success', 'Successfully Registered, Welcome to ReXsteam');
    }
}
