<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

            if ($request->expectsJson()) {
                return response()->json(['message' => 'Authenticated'], 200);
            }

            return response()->json(['success' => true]);
        } else {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }
    }
}
