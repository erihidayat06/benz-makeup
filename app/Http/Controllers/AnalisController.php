<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

class AnalisController extends Controller
{
    public function index()
    {
        $this->authorize('admin');
        return view('dashboard.analis.index',[
            'allTransaksi' => Transaksi::all(),
            'cancel' => Transaksi::latest()->pesanancancel()->get(),
            'pesanan' => Transaksi::latest()->pesanan()->get(),
            'transaksi' => Transaksi::latest()->cancel()->get()

        ]);
    }
}
