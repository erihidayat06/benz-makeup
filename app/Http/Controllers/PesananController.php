<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Komentar;
use App\Models\Transaksi;
use Clockwork\Request\Request;

class PesananController extends Controller
{
    public function index()
    {
        $notif = count(Transaksi::latest()->transaksi()->get());
        dd($notif);
        return view('pesanan.index',[
            'pesanan' => Transaksi::with(['pilihan','komentar'])->latest()->cancel()->get(),
            'notif' => $notif,
            'categories' => Category::all(),
        ]);
    }

}
