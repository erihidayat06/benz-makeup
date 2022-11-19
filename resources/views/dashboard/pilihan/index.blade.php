@extends('dashboard.layout.main')

@section('container')



<div class="container">
  <h1>Halaman {{ $judul }}</h1>
</div>



<div class="container mt-3">
    {{-- input Pencarian --}}
    <form action="/dashboard/pilihan">
    @csrf
    <div class="input-group mb-3">
      @if (request('category'))
          <input type="hidden" name="category" value="{{ request('category') }}">
      @endif
      <input type="text" class="form-control" name="cari" placeholder="Cari Transaksi" value="{{ request('cari') }}">
      <button class="btn btn-primary"  type="submit" id="button-addon2">Cari</button>
    </div>
    </form>

  <a href="/dashboard/pilihan/create" class="btn btn-primary" role="button">Tambahkan Pilihan</a>
</div>

@include('sweetalert::alert')

<div class="container mt-3">
  <div class="dropdown">
  <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
    {{ $judul }}
  </button>
  <ul class="dropdown-menu dropdown-menu-dark">
    <li><a class="dropdown-item" href="/dashboard/pilihan">All</a></li>
    @foreach ($categories as $category)
      <li><a class="dropdown-item" href="/dashboard/pilihan?category={{ $category->slug }}">{{ $category->nama }}</a></li>
    @endforeach
  </ul>
  </div>
</div>



<div class="mt-3" style="margin-left: 50%">{{ $pilihans->links() }}</div>
<div class="table-responsive col-lg-8 mt-3">
  <table class="table table-striped text-start table-bordered table-sm">
    <thead>  
      <tr>
        <th scope="col">#</th>
        <th scope="col">Jenis Makeup</th>
        <th scope="col">harga</th>
        <th scope="col">category</th>
        <th scope="col">Option</th>
      </tr>
      </thead>
      <tbody>

      <?php $i=1 ?>
      @foreach ($pilihans as $pilih)
        
      <tr>
        <td><?=$i++?></td>
        <td>{{ $pilih->jns_makeup }}</td>
        <td>{{ $pilih->harga }}</td>
        <td>{{ $pilih->category->nama }}</td>
        <td>
          <a href="/dashboard/pilihan/{{ $pilih->slug }}" class="badge bg-success" ><i class="bi bi-eye"></i></a>
          <a href="/dashboard/pilihan/{{ $pilih->slug }}/edit" class="badge bg-warning" ><i class="bi bi-pencil-square"></i></a>

          <form action="/dashboard/pilihan/{{ $pilih->slug }}" method="post" class="d-inline">
            @method('delete')
            @csrf
          <button type="submit" class="badge bg-danger border-0 " onclick="return confirm('Apa Kamu Yakin')"><i class="bi bi-x-circle"></i></button>
          </form>
        </td>
      </tr>
      
      @endforeach
      </tbody>
    </table>
</div>
</div>

      

@endsection