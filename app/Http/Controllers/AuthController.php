<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Console\Input\Input;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login', [
            'title' => 'login'
        ]);
    }

    public function login(Request $request)
    {
        $message = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);


        if (Auth::attempt($message)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return redirect()->back()->with("error", "Invalid Email OR Password")->withInput($request->all());
    }

    public function logout(Request $request)
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();
        return redirect('/auth/login');
    }
}
