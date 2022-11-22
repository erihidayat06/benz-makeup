@extends('layouts.main')

@section('container')

@include('sweetalert::alert')
<div style="margin-top:65px" class="container">

{{-- Tampilan Pilih --}}
<div style="border-radius:5px" class="row g-0 bg-light position-relative mt-2 shadow-sm">
  <div style="max-height:505px; overflow: hidden; " class="col-md-5 mb-md-0 p-md-4">
    <span type="button" data-bs-toggle="modal" data-bs-target="#pilih">
       <img  src="{{ asset('storage/' . $pilih->gambar) }}" width="100%" alt="...">
    </span> 
  </div>
  <div class="col-md-6 p-4 ps-md-0">
    <h1 class="mt-0 fw-bold">{{ $pilih->jns_makeup }}</h1>
    
    <p class="mt-5 fw-bold">kategori</p>
    <h1>{{ $pilih->category->nama }}</h1>
    
    <p class="mt-5 fw-bold">Harga</p>
    <div class="mb-4">
      <h1>Rp {{ number_format($pilih->harga,0,",",".")  }}</h1>
    </div>
{{-- akhir Tampilan Pilih --}}
    
@auth
<!-- Button trigger modal Pesan sekarang -->
<button style="padding: 0; width:100%; padding-top:3px" type="button" class="btn btn-primary d-inline mt-5 mb-5" data-bs-toggle="modal" data-bs-target="#exampleModal">
  <h3>Pesan Sekarang</h3> 
</button>
@else
<a style="padding: 0; width:100%; padding-top:3px" href="/login" class="btn btn-primary mt-5 mb-5">
  <h3>Pesan Sekarang</h3> </a>
@endauth
  </div>
</div>
{{-- Akhir Button trigger modal --}}

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Form Pembelian</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
       <form action="/transaksi" method="post">
            @csrf
            <input type="hidden" value="{{ $pilih->id }}" name="pilihan_id">
            <div class="mb-3">
            <label for="jns_makeup" class="form-label">Jenis Makeup</label>
            <input type="text" id="jns_makeup" name="jns_makeup" value="{{ $pilih->jns_makeup }}" class="form-control" placeholder="{{ $pilih->jns_makeup }}" disabled>
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga</label>
                <input type="number" class="form-control d-block" name="harga" placeholder="{{ $pilih->harga }}" value="{{ $pilih->harga }}" disabled>
            </div>
            <div class="mb-3">
                <label for="tgl_acara" class="form-label">Tanggal Acara</label>
                <input type="date" id="tgl_acara" class="form-control d-block @error('no_telp') is-invalid @enderror" name="tgl_acara" required>
                 @error('tgl_acara')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
                @enderror
              </div>
            <div class="mb-3">
                <label for="no_telp" class="form-label">Nomor Telepon</label>
                <input type="number" id="no_telp" class="form-control d-block @error('no_telp') is-invalid @enderror" name="no_telp" required>
                 @error('no_telp')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            </div>
            <div class="mb-3">
                <label for="alamat" class="form-label">Alamat</label>
                <textarea name="alamat" class="d-block @error('no_telp') is-invalid @enderror" id="alamat" cols="45" rows="3" required></textarea>
                 @error('alamat')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror
            </div>     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Lanjut Bayar</button>
      </div>
      </form>
    </div>
  </div>
</div>
{{-- Akhir Modal --}}


{{-- Deskripsi --}}
 <div class="card mt-2 shadow-sm"  style="margin-bottom: 300px;">
  <div class="card-header fw-bold">
   <h2>Deskripsi</h2> 
  </div>
    <div class="card-body">
      <p class="card-text">{!! $pilih->deskripsi !!}</p>
    </div>
  </div>
</div>
{{-- Akhir Deskripsi --}}



<!-- Modal -->
<div class="modal fade" id="pilih" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog d-flex align-items-center">
    <div  class="modal-content">
      <div class="modal-body p-0">
        <div class="gambar d-flex justify-content-center">
        <img width="75%" height="100%" src="{{ asset('storage/' . $pilih->gambar) }}" alt="">
        </div>

      </div>
    </div>
  </div>
</div>


@endsection
