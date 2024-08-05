<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;

class AuthController extends Controller
{
    public function login()
    {
        return view('nonlogin.login', [
            'title' => 'Login Admin'
        ]);
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if ($request->remember_me) {
                Cookie::queue('cookie_name', $request->username, 5);
                Cookie::queue('cookie_pass', $request->password, 5);
            } else {
                Cookie::queue('cookie_name', $request->username, -1);
                Cookie::queue('cookie_pass', $request->password, -1);
            }

            if ($request->expectsJson()) {
                return response()->json(['message' => 'Authenticated'], 200);
            }

            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return response()->json(['success' => true]);
    }
}
