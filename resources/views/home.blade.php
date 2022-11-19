@extends('layouts.main')

@section('container')

{{-- jumbotron --}}
<div class="jumbotron">
  <div class="img">
    <img width="400px" src="https://s3-alpha-sig.figma.com/img/3865/9eea/6d33d9ec618995c486b796d4668fd8a5?Expires=1669593600&Signature=G0FcSzGMg9c6LEyVqKCpt44ngcxBCUqj66UKe~82tCvVp-e3h8gPcfHIgdQeLZjN9c7yo0wVjVu9qiLuqW1j2UMXvKyNZde10kKdWZQRnWs58L8Ace-NTuhm~fRdbbljSpBBsfqM4lqFnYzDQwdUQiFO3tIisCKhqYXehYKPOcEBLKyQ430-eAYSMThULppa421IsvofRo0gmTehL3XVC2opU-X8QKU1bTxSY11lyWla2ExvGki5tudwseqyC6iQJZFzbSM3TgXVkz9mvhi7NySrTExUUBHczhYRW7R3pxldOG7Lske51mRH3EyxhakiPY3dkPiAYXUPy9ms2IbHsQ__&Key-Pair-Id=APKAINTVSUGEWH5XD5UA" alt="">
  </div>
  
</div>
{{-- akhir jumbotron --}}

{{-- category --}}
<div style="margin-bottom: 200px" class="container">
<div class="hr-category">
  <h1>Select Category</h1>
</div>

<div class="row row-cols-md-3 cols-md-4 g-4">
@foreach ($categories as $category)
<a class="text-decoration-none" href="/pilihan?category={{ $category->slug }}">
  <div class="col">
    <div class="card h-100  shadow">
    <div class="mx-2 my-2"  style="max-height: 150px; overflow:hidden;">
        <img width="200px" src="{{ asset('storage/' . $category->gambar) }}" class="card-img-top" alt="...">
     </div> 
        <div class="card-body">
        <h5 class="card-title text-center fs-4 text-dark fw-bold">{{ $category->nama }}</h5>
      </div>
    </div>
  </div>
</a>
@endforeach
</div>  
</div>
{{-- akhir category --}}
@endsection

