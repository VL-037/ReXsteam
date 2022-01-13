<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    public function index() {
        $haveUser = Auth::user();
        if ($haveUser) {
            return redirect('/');
        }
        return view('users.login');
    }

    public function login(Request $request){
        $username = $request->username;
        $password = $request->password;
        $remember = $request->remember;

        if (Auth::attempt(['username' => $username, 'password' => $password], $remember)) {
            $lifetime = time() + 60 * 60 * 2;
            
            if ($remember) {
                $key = Auth::getRecallerName();
                $value = Auth::user()->getRememberToken();
                Cookie::queue($key, $value, $lifetime);
            }

            return redirect()->intended();
        }

        return redirect('/login')->with('error', 'Invalid Credentials');
    }

    public function logout() {
        Auth::logout();
        return redirect('');
    }
}
