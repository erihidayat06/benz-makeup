@extends('dashboard.layout.main')

@section('container')

<div class="container">
    <div class="col-lg-8">
        <h1 class="h2">{{ $pilihan->jns_makeup }}</h1>
        <img src="{{ asset('storage/' . $pilihan->gambar) }}" alt="" width="400px">
        <p>{!! $pilihan->deskripsi !!}</p>
    </div>
</div>

@endsection