<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Illuminate\Http\Request;

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

        $this->authorize('admin');
        return view('dashboard.transaksi.index',[
            'judul' => 'Tabel ' . $judul,
            'active' => $active,
            'transaksis' => Transaksi::latest()->filter(request(['cancel','acc_pesanan','cari']))->paginate(5)->withQueryString()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
       if($request->no_telp == null || $request->alamat == null || $request->tgl_acara == null){
            
            return back()->with('info', 'Data Belum Di Isi Semua');
        }

        $validateData = $request->validate([
            "pilihan_id" => "required",
            "tgl_acara" => "required|date",
            "no_telp" => "required|max:255",
            "alamat" => "required|max:255",
            "no_pesanan" => "unique:transaksis",
        ]);
         

        $validateData['user_id'] = auth()->user()->id;
        $validateData['no_pesanan'] = substr(auth()->user()->name, 0, 2) . rand(0,9999) . substr(md5(time()), 0, 4) . substr($request->no_telp, -4);


        

        if(Transaksi::create($validateData)){

                $uniq_user = auth()->user()->uniq;

                return redirect("/pesanan?uniq_user=$uniq_user")->with('success', 'Data Pesanan Berhasil Di tambahkan');
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
        //
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

        $rules = $request->validate([
            'acc_pesanan' => 'required',
            'cancel' => 'required'
        ]);

 
        if(request('acc_pesanan') == 0){
            $rules['acc_pesanan'] = 1;
            $rules['cancel'] = $transaksi->cancel;
        }
        if(request('acc_pesanan') == 1){
            $rules['acc_pesanan'] = 0;
            $rules['cancel'] = $transaksi->cancel;
        }

        if(request('cancel') == 1){
            $rules['cancel'] = 0;
            $rules['acc_pesanan'] = $transaksi->acc_pesanan;
        }
        if(request('cancel') == 0){
            $rules['cancel'] = 1;
            $rules['acc_pesanan'] = $transaksi->acc_pesanan;
        }
        

        Transaksi::where('id',$transaksi->id)
                    ->update($rules);

        return redirect('/dashboard/transaksi?cancel=false');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaksi $transaksi)
    {
        //
    }
}
