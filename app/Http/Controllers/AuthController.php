<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index() {
        return view('users.login');
    }

    public function login(Request $request){
        $username = $request->username;
        $password = $request->password;
        $remember = $request->remember;

        if (Auth::attempt(['username' => $username, 'password' => $password], $remember)) {
            return redirect()->intended();
        }

        return redirect('/login')->with('error', 'Invalid Credentials');
    }

    public function logout() {
        Auth::logout();
        return redirect('');
    }
}
