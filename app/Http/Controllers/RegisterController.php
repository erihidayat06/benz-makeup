<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    
    public function index()
    {
        $judul = 'Register';
        return view('register.index',[
            'judul' => $judul
        ]);
    }

    public function store(Request $request)
    {
        
        $validateData = $request->validate([
            'name' => 'required|max:255',
            'username' => ['required', 'min:3', 'max:255', 'unique:users'],
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|max:255',
            'uniq' => 'max:255:unique:users'
        ]);
        
        $validateData['uniq'] = substr(md5(time()), 0, 30);

        $validateData['password'] = Hash::make($validateData['password']);

        User::create($validateData);

        return redirect('/login')->with('success','User Berhasil Di Tambah');
    }
}
