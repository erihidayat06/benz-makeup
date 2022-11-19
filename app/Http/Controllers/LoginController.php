<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        $judul = 'Login';
        return view('login.index',[
            'judul' => $judul
        ]);
    }

    public function authenticate(Request $request)
    {

        $credential= $request->validate([
            "email" => 'required|email',
            "password" => 'required'
        ]);

        

        if(Auth::attempt($credential)){
             $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()->with('loginError', 'Login Falid');

    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
