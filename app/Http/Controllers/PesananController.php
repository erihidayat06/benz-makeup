<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;

class PesananController extends Controller
{
    public function index()
    {
        return view('pesanan.index',[
            'pesanan' => Transaksi::latest()->cancel()->get(),
            'notif'=> Transaksi::latest()->transaksi()->get(),
            'categories' => Category::all()
        ]);
    }
}
