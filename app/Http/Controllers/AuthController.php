<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index() {
        return view('login');
    }

    public function login(Request $request){
        $username = $request->username;
        $password = $request->password;

        if (Auth::attempt(['username' => $username, 'password' => $password])) {
            return redirect()->intended();
        }

        return back();
    }

    public function logout() {
        Auth::logout();
        return redirect('');
    }
}
