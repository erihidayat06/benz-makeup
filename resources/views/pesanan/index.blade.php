@extends('layouts.main')

@section('container')

@include('sweetalert::alert')



<div style="margin-top:70px; margin-bottom:300px;" class="container">
  <legend>Table Pesanan - {{ auth()->user()->name }}</legend>
<p class="alert alert-primary">Jika Status <span class="text-danger fw-bold"> Tunggu </span>Segera Lakukan Pemabayaran Dengan Mengklik Tombol <span class="fw-bold">Bayar</span> </p>


<table class="table">
  <tbody>
<?php $i = 1?>
@foreach ($pesanan as $pesan)  
    <tr>
      <td>
{{-- Table Pemesanan --}}
<div style="overflow: hidden" class="card shadow-sm">
  <div class="nomor">
  {{ $i++ }}
  </div>
  <div class="row row-cols-2 row-cols-lg-2">
    <div style="max-width: 115px; padding-right:0" class="col-lg-2">
      <div style="max-height: 100px; overflow:hidden;">
        <img  width="90px"  src="{{ asset('storage/' . $pesan->pilihan->gambar) }}" alt="">
      </div>
    </div>


    {{-- Card Body Pemesanan --}}
      <div class="card-body">
        <span class="card-title"><a class="fw-bold text-decoration-none" href="/pilih/{{ $pesan->pilihan->slug }}">{{ $pesan->pilihan->jns_makeup }}</a></span>
        <div class="row row-cols-1 row-cols-lg-3">
        <div class="col">     
              <div class="row row-cols-2">
              <span class="col"><span style="font-size: 11px" class="text-muted">Tanggal Acara :</span><br><span style="font-size: 13px">{{ date('d M Y', strtotime( $pesan->tgl_acara)) }}</span></span>
              <span class="col"><span style="font-size: 11px" class="text-muted">Tanggal Pesan :</span><br><span style="font-size: 13px">{{ date('d M Y', strtotime( $pesan->created_at)) }}</span></span>
              </div>    
        </div>
        <div class="col">    
            <span style="font-size: 11px" class="text-muted">Harga :</span><br> Rp{{ number_format($pesan->pilihan->harga,0,",",".")  }}  
        </div>    
        <div class="col">
            @if ($pesan->selesai == true)
              <span style="font-size: 11px" class="text-muted">Status :</span>
              <p style="color: green; font-weight: bold">Selesai</p>
            @elseif($pesan->acc_pesanan == true)
            <span style="font-size: 11px" class="text-muted">Status :</span>
              <p style="color: rgb(1, 1, 121); font-weight: bold">sukses</p>
            @else
              <span style="font-size: 11px" class="text-muted">Status :</span>
              <p style="color:red; font-weight: bold">Tunggu</p>
            @endif
        </div>
      </div>
     </div> 
</div>
 <hr style="margin: 0;"> 
<div class="col-lg-12 p-3 py-1">
  <div class="row row-cols-2">
  <div class="col">
    <div id="print"><a id="bi-print" href="/pesanan/{{ $pesan->no_pesanan }}" title="Print Pesanan" target="_blank" class="text-decoration-none" id="struk">print pesanan </a><i class="bi bi-printer"></i></div>
  </div>
  <div class="col d-flex justify-content-end">
  {{-- Pembayaran --}}
  @if ($pesan->selesai == false)
      @if ($pesan->acc_pesanan == true)
      <a class="fw-bold btn btn-sm btn-danger" target="_blank" href="https://api.whatsapp.com/send?phone=6285647715796&text=*Pembatalan%20Pesanan*%0ANama%20:*%20{{ auth()->user()->name }}%0A*Jenis%20Makeup%20:*%20{{ $pesan->pilihan->jns_makeup }}%0A*Harga%20:*%20Rp%20{{ number_format($pesan->pilihan->harga,0,",",".")  }}%0A*Alamat%20:*%20{{ $pesan->alamat }}%0A*Tanggal%20Acara%20:*%20{{ date('d M Y', strtotime( $pesan->tgl_acara)) }}%0A*Tanggal%20Pesanan%20:*%20{{ date('d M Y', strtotime( $pesan->created_at)) }}%0A*No%20Pesanan%20:*%20{{ $pesan->no_pesanan }}">Batalkan</a>
    @else
      <a class="fw-bold btn btn-sm btn-primary px-4" target="_blank" href="https://api.whatsapp.com/send?phone=6285647715796&text=*Data%20Pembayaran*%0A*Nama%20:*%20{{ auth()->user()->name }}%0A*Jenis%20Makeup%20:*%20{{ $pesan->pilihan->jns_makeup }}%0A*Harga%20:*%20Rp%20{{ number_format($pesan->pilihan->harga,0,",",".") }}%0A*Alamat%20:*%20{{ $pesan->alamat }}%0A*Tanggal%20Acara%20:*%20{{ date('d M Y', strtotime( $pesan->tgl_acara)) }}%0A*Tanggal%20Pesanan%20:*%20{{ date('d M Y', strtotime( $pesan->created_at)) }}%0A*No%20Pesanan%20:*%20{{ $pesan->no_pesanan }}">Bayar</a>
      <form action="/transaksi/{{ $pesan->id }}" method="post">
        @csrf
        @method('delete')
      <button type="submit" style="margin-left: 10px" class="fw-bold btn btn-sm btn-danger" onclick="return confirm('Yakin Mau Di Batalkan')">Batalkan</button>
      </form>
      @endif
  @endif
            
    {{-- Akhir pembayaran --}}

    {{-- Rating --}}
    @if ($pesan->selesai == true)        
      @if (isset($pesan->komentar->first()->id))
      <?php $rating = "rating" . $pesan->id ?>
      <!-- Button trigger modal Rating -->
      <button style="margin-left: 10px" type="button" class="btn btn-sm btn-success text-light fw-bold" data-bs-toggle="modal" data-bs-target="#{{ $rating }}">
        Ulasan
      </button>
      <div class="modal fade" id="{{ $rating }}" tabindex="-1" aria-labelledby="ratingModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="btn-sm btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
          <h5>Rating Kamu</h5>
          <div class="d-flex justify-content-center align-items-center">
              <div style="padding: 0 10px; color:#676767; font-size: 30px" class="ratings">
                  <i class="{{ ($pesan->komentar->first()->rating >= 1 ? 'text-warning bi bi-star-fill' : 'bi bi-star')  }}"></i>
                  <i class="{{ ($pesan->komentar->first()->rating >= 2 ? 'text-warning bi bi-star-fill' : 'bi bi-star')  }}"></i>
                  <i class="{{ ($pesan->komentar->first()->rating >= 3 ? 'text-warning bi bi-star-fill' : 'bi bi-star')  }}"></i>
                  <i class="{{ ($pesan->komentar->first()->rating >= 4 ? 'text-warning bi bi-star-fill' : 'bi bi-star')  }}"></i>
                  <i class="{{ ($pesan->komentar->first()->rating >= 5 ? 'text-warning bi bi-star-fill' : 'bi bi-star') }} "></i>
              </div>
          </div>

          <h5 class="mt-3">Komentar</h5>
          <p>{!! nl2br($pesan->komentar->first()->komentar) !!}</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  @else
    <?php $komen = 'komen' . $pesan->id?>
      <!-- Button trigger modal Rating -->
        <a href="" style="margin-left: 10px" type="button" class="btn btn-sm btn-warning text-light fw-bold" data-bs-toggle="modal" data-bs-target="#{{ $komen }}">
          Beri ulasan
        </a>
      @endif
      
      @else
      <p></p>
      @endif            
    </div>
  </div>
</div>
  
  
 <!-- Modal Komentar-->
 <?php $komen = 'komen' . $pesan->id?>
<div class="modal fade" id="{{ $komen }}" tabindex="-1" aria-labelledby="{{ $komen }}Label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body fw-bold text-center">
        
        <form action="/komentar" method="post">
          @csrf
          <input type="hidden" value="{{ $pesan->id }}" name="transaksi_id">
          <input type="hidden" value="{{ $pesan->pilihan->id }}" name="pilihan_id">
          <div class="mb-3">
            <label for="bintang" class="form-label ">BERI NILAI</label>
            <div class="rate text-white">
                <div  class="rating"> 
                  <input type="radio" name="rating" value="5" id="{{ $komen . '5' }}"><label class="fs-1" for="{{ $komen . '5' }}" data-bs-toggle="tooltip" data-bs-title="Super Bagus">☆</label> 
                  <input type="radio" name="rating" value="4" id="{{ $komen . '4' }}"><label class="fs-1" for="{{ $komen . '4' }}" data-bs-toggle="tooltip" data-bs-title="Bagus">☆</label> 
                  <input type="radio" name="rating" value="3" id="{{ $komen . '3' }}"><label class="fs-1" for="{{ $komen . '3' }}" data-bs-toggle="tooltip" data-bs-title="B Aja">☆</label> 
                  <input type="radio" name="rating" value="2" id="{{ $komen . '2' }}"><label class="fs-1" for="{{ $komen . '2' }}" data-bs-toggle="tooltip" data-bs-title="Jelek">☆</label> 
                  <input type="radio" name="rating" value="1" id="{{ $komen . '1' }}"><label class="fs-1" for="{{ $komen . '1' }}" data-bs-toggle="tooltip" data-bs-title="Jelek Banget">☆</label>
                </div>    
            </div>
          </div>
          <div class="mb-3">
            <label for="komen" class="form-label">KOMENTAR</label>
            <textarea class="form-control" name="komentar" id="komen" cols="10" rows="5" placeholder="Beri Komentar untuk makeup {{ $pesan->pilihan->jns_makeup }}" required></textarea>
          </div>
          
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-sm btn-primary">Beri Nilai</button>
      </div>
      </form>
    </div>
  </div>
</div>
</div>
{{-- Akhir Modal Komentar --}}
      </td>
      
    </tr>
    @endforeach
  </tbody>
</table>

{{-- Tidak Ada Pesanan --}}
@if (!isset($pesan->id))
  <div class="d-flex justify-content-center">
    <img style="opacity: 0.6" src="/img/pesanan.gif" alt="...." width="100px">
  </div>
  <div class="d-flex justify-content-center text-muted">
      <h2>Belum Ada Pesanan</h2> 
  </div>
@endif
</div>
</div>



@endsection
