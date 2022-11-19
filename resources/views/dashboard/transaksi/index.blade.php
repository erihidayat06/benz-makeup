@extends('dashboard.layout.main')

@section('container')

@include('sweetalert::alert')

<h1>{{ $judul }}</h1>

{{-- input Pencarian --}}
<form action="/dashboard/transaksi">
@csrf
<div class="input-group mb-3">
  <input type="text" class="form-control" name="cari" placeholder="Cari Transaksi" value="{{ request('cari') }}">
  <button class="btn btn-primary"  type="submit" id="button-addon2">Cari</button>
</div>
</form>

<div class="card text-center mb-3">
  <div class="card-header">
    <ul class="nav nav-tabs card-header-tabs">
      <li class="nav-item">
         <a class="nav-link {{ ($active == 'cancel') ? 'active' : '' }} fw-bold" aria-current="page" href="/dashboard/transaksi?cancel=1">CANCEL</a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ ($active == 'tunggu') ? 'active' : '' }} fw-bold" aria-current="page" href="/dashboard/transaksi?acc_pesanan=false&active=aktif&cancel=false">Tunggu</a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ ($active == 'sukses') ? 'active' : '' }} fw-bold" aria-current="page" href="/dashboard/transaksi?acc_pesanan=1&cancel=false">Sukses</a>
      </li>
    </ul>
  </div>
  <div class="card-body">



    
<div class="float-end">{{ $transaksis->links() }}</div>

<div class="table-responsive col-lg-12 mt-3  d-block">
  <table class="table table-striped text-start table-bordered table-sm">
    <thead>  
      <tr>
        <th scope="col">#</th>
        <th scope="col">Nama</th>
        <th scope="col">Pilihan</th>
        <th scope="col">Harga</th>
        <th scope="col">Tanggal_Acara</th>
        <th scope="col">No_Telepon</th>
        <th scope="col">Alamat</th>
        <th scope="col">No_Pesanan</th>
        <th scope="col">Status</th>
        <th scope="col">________Action________</th>
      </tr>
      </thead>
      <tbody>

      <?php $i=1 ?>
      @foreach ($transaksis as $transaksi)
        
      <tr>
        <th scope="row"><?=$i++?></th>
        <td>{{ $transaksi->user->name }}</td>
        <td>{{ $transaksi->pilihan->jns_makeup }}</td>
        <td>{{ $transaksi->pilihan->harga }}</td>
        <td>{{ date('d M Y', strtotime($transaksi->tgl_acara)) }}</td>
        <td>{{ $transaksi->no_telp }}</td>
        <td>{!! $transaksi->alamat !!}</td>
        <td>{{ $transaksi->no_pesanan }}</td>
        <td>
          @if ($transaksi->acc_pesanan == true)
              <p style="color: green; font-weight: bold">sukses</p>
          @else
              <p style="color:red; font-weight: bold">Tunggu</p>
          @endif
        </td>
        <td>

          {{-- Tombol Acc --}}
          @if ($transaksi->acc_pesanan)
            <form action="/dashboard/transaksi/{{ $transaksi->id }}" method="post" class="d-inline">
            @method('PUT')
            @csrf   
            <input type="hidden" name="acc_pesanan" value="{{ $transaksi->acc_pesanan }}">
            <input type="hidden" name="cancel" value="-">
            <button type="submit" class="badge btn-warning px-2 text-dark float-start">Batal</button>
            </form>
          
          @else
            <form action="/dashboard/transaksi/{{ $transaksi->id }}" method="post" class="d-inline">
            @method('PUT')
            @csrf 
            <input type="hidden" name="cancel" value="-">  
            <input type="hidden" name="acc_pesanan" value="{{ $transaksi->acc_pesanan }}">
            <button type="submit" class="badge btn-primary px-3 float-start">Acc</button>
            </form>
          @endif
          
            {{-- Tombol Cancel --}}
            @if ($transaksi->cancel == 1)
             <form action="/dashboard/transaksi/{{ $transaksi->id }}" method="post" class="d-inline">
            @method('PUT')
            @csrf   
            <input type="hidden" name="cancel" value="{{ $transaksi->cancel }}">
             <input type="hidden" name="acc_pesanan" value="-">
          <button type="submit" class="badge btn-success float-end">Kembalikan</button>
          </form>
            @else
            <form action="/dashboard/transaksi/{{ $transaksi->id }}" method="post" class="d-inline">
            @method('PUT')
            @csrf   
            <input type="hidden" name="cancel" value="{{ $transaksi->cancel }}">
             <input type="hidden" name="acc_pesanan" value="-">
          <button type="submit" class="badge btn-danger float-end px-3">Cancel</button>
          </form>
            @endif
           
         
          
        </td>
      </tr>
      
      @endforeach
      </tbody>
    </table>
    
</div>
</div>
  </div>
</div>









@endsection