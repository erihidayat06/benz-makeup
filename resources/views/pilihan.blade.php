@extends('layouts.main')    

@section('container')

<div style="margin-bottom: 300px; margin-top:70px" class="container">

@if (request('category'))
    <h3 class="mt-3 fw-bold">CATEGORY {{ $category->nama }}</h3>
@else
    <h3 class="mt-3 fw-bold">CATEGORY All</h3>
@endif

{{-- input Pencarian --}}
<form action="/pilihan">
@csrf
<div class="input-group mb-3 shadow-sm">
  @if (request('category'))
      <input type="hidden" name="category" value="{{ request('category') }}">
  @endif
  <input type="text" class="form-control" name="cari" placeholder="Cari Makeup..." value="{{ request('cari') }}">
  <button class="btn btn-primary"  type="submit" id="button-addon2">Cari</button>
</div>
</form>

{{-- Navbar Category Pilihan --}}
<nav class="navbar bg-light mb-3 shadow-sm g-4">
  <form class="container-fluid pt-1 justify-content-start">
    @if (request('category'))
      <a href="/pilihan" class="btn btn-sm btn-secondary me-2 mb-1" type="button">All</a>
    @else
      <a href="/pilihan" class="btn btn-success me-2 mb-1" type="button">All</a>
    @endif
      
    {{-- Menampilkan category max 10 --}}
 
      @foreach ($kategori->take(10) as $kate)        
        @if (request('category') === $kate->slug)
        <a href="/pilihan?category={{ $kate->slug }}" class="btn btn-outline-success me-2 mb-1" type="button">{{ $kate->nama }}</a>        
        @else
        <a href="/pilihan?category={{ $kate->slug }}" class="btn btn-sm btn-outline-secondary me-2 mb-1" type="button">{{ $kate->nama }}</a>
        @endif
        
      @endforeach
      
      {{-- category all --}}
      <?php $i = 0?>
      @foreach ($kategori as $kate)
         <?php $i++?> 
      @endforeach

      {{-- Menampilkan category lainya --}}
     @if ($i > 10)
      <div class="btn-group text-secondary">
        <span class="dropdown-toggle mb-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
          Category Lainnya
        </span>
        <ul class="dropdown-menu">
          @foreach ($kategori->skip(10) as $gori)
              <li><a class="dropdown-item" href="/pilihan?category={{ $gori->slug }}">{{ $gori->slug }}</a></li>
          @endforeach
        </ul>
      </div>
     @endif
  </form>
</nav>
{{-- akhir Navbar Kategory Pilihan --}}


{{-- Colom Pilihan --}}
<div  class="row row-cols-2 row-cols-lg-6 g-4">
@foreach ($pilihan as $pilih)
  <div  class="col d-flex justify-content-center">  
    <div style="height: 280px; width:155px;" id="card-pesanan"  class="card">
      <a class="text-decoration-none" href="/pilih/{{ $pilih->slug }}">
    <div style="max-height: 150px; overflow:hidden">
         <img src="{{ asset('storage/' . $pilih->gambar) }}" class="card-img-top" alt="...">
    </div> 
      <div id="makeup-pilihan" class="card-body p-2 px-2">
        <h5 style="color: #231955" class="card-title fw-bold">{{ $pilih->jns_makeup }}</h5>    
      </div>
      <span style="margin-left: 12px; " class="small font-weight-bold">{{ $pilih->category->nama }}</span>
      <div style="padding: 0 10px; color:red"><p class="card-text fs-6 fw-bold">Rp {{ number_format($pilih->harga,0,",",".") }}</p></div>  
    </a>
    </div>   
  </div>
  @endforeach
</div>


{{-- Akhir Colom Pilihan --}}


<div class="container mt-5">
{{ $pilihan->links() }}
</div>  

  
</div>



@endsection