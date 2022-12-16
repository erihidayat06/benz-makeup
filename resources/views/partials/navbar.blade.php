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
          <a type="button" class="nav-link active" data-bs-toggle="modal" data-bs-target="#lokasi">
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
              @if ($notif<=0)
                 <span class=""> 
                <span class="visually-hidden">unread messages</span></span></a></li>
              @else
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger"> 
                {{ $notif }}
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
<div class="modal fade" id="lokasi" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Location</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d1247.5352549782385!2d109.1503116373004!3d-6.929084347834219!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6fb8dd67f83e17%3A0x6334933d1ceceea3!2sJl.%20Pecakran%20Pasangan%20No.1928%2C%20Pasangan%2C%20Kec.%20Talang%2C%20Kabupaten%20Tegal%2C%20Jawa%20Tengah%2052193!5e0!3m2!1sid!2sid!4v1668663998353!5m2!1sid!2sid" width="450" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        
          <h4 class="fw-bold">Location Benz Makeup</h4>
         <h5>Jl. Pecakran Pasangan No.1928</h5> 
        <p>
          Jl. Pecakran Pasangan No.1928, Pasangan, Kec. Talang, Kabupaten Tegal, Jawa Tengah 52193
        </p>
      </div>
    </div>
  </div>
</div>



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

