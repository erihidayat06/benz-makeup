<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use PHPUnit\Framework\MockObject\Stub\ReturnStub;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $active = '';
        $judul = 'Transaksi';
        if(request('cancel') == 1){
            $judul = 'Cancel';
            $active = 'cancel';
        }

        if(request('acc_pesanan') == 1){
            $judul = 'ACC Sukses';
            $active = 'sukses';
        }
        if(request('active') === 'aktif'){
            $judul = 'ACC Tunggu';
            $active = 'tunggu';
        }
        if(request('selesai') == 1){
            $judul = 'Selesai';
            $active = 'selesai';
        }

        $this->authorize('admin');
        return view('dashboard.transaksi.index',[
            'judul' => 'Tabel ' . $judul,
            'active' => $active,
            'transaksis' => Transaksi::with(['pilihan','user'])->latest()->filter(request(['cancel','acc_pesanan','cari','selesai']))->paginate(5)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validateData = $request->validate([
            "pilihan_id" => "required",
            "tgl_acara" => "required|date",
            "no_telp" => "required|min:7|max:255",
            "alamat" => "required|max:255",
            "no_pesanan" => "unique:transaksis",
        ]);

        $validateData['user_id'] = auth()->user()->id;
        $validateData['no_pesanan'] = strtoupper(substr(auth()->user()->name, 0, 2) . rand(0,9999) . substr(md5(time()), 0, 4) . substr($request->no_telp, -4));
        
        
            
        if(Transaksi::create($validateData)){
            return redirect("/pesanan")->with('success', 'Data Pesanan Berhasil Di tambahkan');
        }

            

        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show(Transaksi $transaksi)
    {
        $data = PDF::loadView('pesanan.print',
        ['transaksi'=>$transaksi]);
        return $data->stream('pesanan.print');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaksi $transaksi)
    {
 
        $this->authorize('admin');
        if(request('acc_pesanan') == 0){
            $rules['acc_pesanan'] = 1;
        }
        if(request('acc_pesanan') == 1){
            $rules['acc_pesanan'] = 0;
        }

        if(request('cancel') == 1){
            $rules['cancel'] = 0;
        }

        if(request('cancel') == 0){
            $rules['cancel'] = 1;
        }

        if(request('selesai') == 0){
            $rules['selesai'] = 1;
        }

        if(request('selesai') == 1){
            $rules['selesai'] = 0;
        }

        

        Transaksi::where('id',$transaksi->id)
                    ->update($rules);

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaksi $transaksi)
    {
        $this->authorize('admin');
        Transaksi::destroy($transaksi->id);
        return redirect('/pesanan')->with('success', 'Pesanan Telah Di Batalkan');
    }
}
