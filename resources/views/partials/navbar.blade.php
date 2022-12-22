{{-- Awal Navbar --}}
<nav class="navbar fixed-top navbar-expand-lg navbar-dark shadow-sm" id="navbar">
  <div class="container">
    <a class="navbar-brand" href="/">Benz Makeup</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse float-end" id="navbarNavDropdown">
      <ul class="navbar-nav ms-auto">
        
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle active" href="/pilihan" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Category
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
            <li class="border-bottom"><a class="dropdown-item" href="/pilihan">All</a></li>
            @foreach($categories as $category)
            <li><a class="dropdown-category dropdown-item" href="/pilihan?category={{ $category->slug }}">{{ $category->nama }}</a></li>
            @endforeach
            </li>
          </ul>
          <li class="nav-item">
          <a type="button" class="nav-link active" data-bs-toggle="modal" data-bs-target="#lokasiToggle">
            Location
          </a>
          </li>
          <li class="nav-item">
            <a type="button" class="nav-link active" data-bs-toggle="modal" data-bs-target="#about">
            About
          </a>
          </li>
      @auth
        <li class="nav-item dropdown">
          <a class="nav-link" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            {{ auth()->user()->name }} <i class="bi bi-person-circle position-relative">
            </i>
          </a>
          <ul class="dropdown-menu">
            <li>
              <a class="dropdown-item position-relative" href="/pesanan">
              <i class="bi bi-cart2"></i>
                Pesanan 
              @if (count($notif)<=0)
                 <span class=""> 
                <span class="visually-hidden">unread messages</span></span></a></li>
              @else
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"> 
                {{ count($notif) }}
                <span class="visually-hidden">unread messages</span></span></a></li>
              @endif
              
            @can('admin')
            <li><a class="dropdown-item" href="/dashboard">
              <i class="bi bi-database-check"></i>
              Dashboard</a></li>
            @endcan
            <li><hr class="dropdown-divider"></li>
            <li>
              <form action="/logout">
              <button type="submit" class="dropdown-item">
                Logout
                <i class="bi bi-box-arrow-right"></i>
              </button>
              </form>
            </li>
          </ul>
        </li>
      @else
      <li class="nav-item">
        <a class="nav-link" href="/login"><i class="bi bi-box-arrow-in-right"></i> Login</a>
      </li>     
      @endauth
    </ul>    
    </div>
  </div>
</nav>
{{-- Akhir navbar --}}







<!-- Modal  Lokasi-->
<div class="modal fade" id="lokasiToggle" aria-hidden="true" aria-labelledby="lokasiToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="lokasiLabel">Location</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1247.5352549782385!2d109.1503116373004!3d-6.929084347834219!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6fb8dd67f83e17%3A0x6334933d1ceceea3!2sJl.%20Pecakran%20Pasangan%20No.1928%2C%20Pasangan%2C%20Kec.%20Talang%2C%20Kabupaten%20Tegal%2C%20Jawa%20Tengah%2052193!5e0!3m2!1sid!2sid!4v1668663998353!5m2!1sid!2sid" width="450" height="250" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        
          <h6 class="fw-bold">Location Benz Makeup</h6>
         <h6>Jl. Pecakran Pasangan No.1928</h6> 
        <p>
          Jl. Pecakran Pasangan No.1928, Pasangan, Kec. Talang, Kabupaten Tegal, Jawa Tengah 52193
        </p>
      </div>
      <div class="modal-footer">
        <button class="btn btn-sm btn-outline-primary" data-bs-target="#lokasiToggle2" data-bs-toggle="modal">Kirim Pesan <i class="bi bi-chat-right-dots"></i></button>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="lokasiToggle2" aria-hidden="true" aria-labelledby="lokasiToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="lokasiToggleLabel2">Form Pesan</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="alert alert-success alert-dismissible fade show d-none my-alert" role="alert">
  <strong>Terima Kasih!</strong> Pesan Anda telah kami terima
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
        <form name="pesan-benz-makeup" >
        <div class="mb-3">
          <label for="nama" class="form-label">Nama</label>
          <input type="text" name="nama" class="form-control" id="nama" autocomplete="off"> 
        </div>
        <div class="mb-3">
          <label for="exampleInputEmail1" class="form-label">Email address</label>
          <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"> 
        </div>
        <div class="mb-3">
          <label for="pesan" class="form-label">Pesan</label>
          <textarea name="pesan" class="form-control" id="pesan" cols="10" rows="5"></textarea>
        </div>
        <button type="submit" class="btn btn-sm btn-outline-primary btn-kirim">Kirim</button>
        <button class="btn btn-sm btn-outline-primary btn-loading d-none" type="button" disabled>
          <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
          Loading...
        </button>
      </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-sm btn-primary" data-bs-target="#lokasiToggle" data-bs-toggle="modal">Back to first</button>
      </div>
    </div>
  </div>
</div>
<a class="btn btn-sm btn-primary" data-bs-toggle="modal" href="#lokasiToggle" role="button">Open first modal</a>



<!-- Modal About -->
<div class="modal fade" id="about" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">
        <h3 class="fw-bold">ABOUT</h3>
        <p>
          With professional staff and the best quality, Benz Makeup embodies the essence of passionate makeup and satisfying results 
        </p>

        <h4 class="fw-bold mt-5">WEBSITE FROM</h4>
        <img width="230px" src="/img/Untitled-1.png" alt="">
      </div>
    </div>
  </div>
</div>

