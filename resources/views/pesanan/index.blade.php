@extends('layouts.main')

@section('container')

@include('sweetalert::alert')



<div style="margin-top:70px" class="container">
<div style="margin-bottom: 300px;" class="table-responsive col-lg-11 mt-3">
<legend>Table Pesanan - {{ auth()->user()->name }}</legend>
<p class="alert alert-primary">Jika Status <span class="text-danger fw-bold"> Tunggu </span>Segera Lakukan Pemabayaran Dengan Mengklik Tombol <span class="fw-bold">Bayar</span> </p>
<table class="table table-bordered bg-light">
    <thead>
      <tr class="bg-primary text-light">
        <th>No</th>
        <th>Jenis_Makeup</th>
        <th>Tanggal_Acara</th>
        <th>Alamat</th>
        <th>Harga</th>
        <th>Tanggal_Pemesanan</th>
        <th>Status</th>
        <th>Pembayaran</th>

      </tr>
    </thead>
    <tbody>
      <?php $i=1 ?>
    @foreach ($pesanan as $pesan)
      <tr>
        <th>{{ $i++ }}</th>    
        <td><a href="/pilih/{{ $pesan->pilihan->slug }}">{{ $pesan->pilihan->jns_makeup }}</a></td>
        <td>{{ date('d M Y', strtotime( $pesan->tgl_acara)) }}</td>
        <td>{{ $pesan->alamat }}</td>
        <td>Rp{{ number_format($pesan->pilihan->harga,0,",",".")  }}</td>
        <td>{{ date('d M Y', strtotime( $pesan->created_at)) }}</td>
        <td>
            @if ($pesan->acc_pesanan == true)
              <p style="color: green; font-weight: bold">sukses</p>
            @else
              <p style="color:red; font-weight: bold">Tunggu</p>
            @endif
        </td>
        <td>
            @if ($pesan->acc_pesanan == true)
              <a class="fw-bold btn btn-danger" target="_blank" href="https://api.whatsapp.com/send?phone=6285647715796&text=*Pembatalan%20Pesanan*%0ANama%20:*%20{{ auth()->user()->name }}%0A*Jenis%20Makeup%20:*%20{{ $pesan->pilihan->jns_makeup }}%0A*Harga%20:*%20Rp%20{{ number_format($pesan->pilihan->harga,0,",",".")  }}%0A*Alamat%20:*%20{{ $pesan->alamat }}%0A*Tanggal%20Acara%20:*%20{{ date('d M Y', strtotime( $pesan->tgl_acara)) }}%0A*Tanggal%20Pesanan%20:*%20{{ date('d M Y', strtotime( $pesan->created_at)) }}%0A*No%20Pesanan%20:*%20{{ $pesan->no_pesanan }}">Batalkan</a>
            @else
              <a class="fw-bold btn btn-primary px-4" target="_blank" href="https://api.whatsapp.com/send?phone=6285647715796&text=*Data%20Pembayaran*%0A*Nama%20:*%20{{ auth()->user()->name }}%0A*Jenis%20Makeup%20:*%20{{ $pesan->pilihan->jns_makeup }}%0A*Harga%20:*%20Rp%20{{ number_format($pesan->pilihan->harga,0,",",".") }}%0A*Alamat%20:*%20{{ $pesan->alamat }}%0A*Tanggal%20Acara%20:*%20{{ date('d M Y', strtotime( $pesan->tgl_acara)) }}%0A*Tanggal%20Pesanan%20:*%20{{ date('d M Y', strtotime( $pesan->created_at)) }}%0A*No%20Pesanan%20:*%20{{ $pesan->no_pesanan }}">Bayar</a>
            @endif
        </td>
      </tr>
    @endforeach
    </tbody>
  </table>
</div>
</div>


@endsection
