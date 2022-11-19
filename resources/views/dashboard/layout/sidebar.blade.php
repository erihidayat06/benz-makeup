<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3 sidebar-sticky">
    <ul class="nav flex-column">
        <li class="nav-item">
        <a class="nav-link {{ Request::is('dashboard') ? 'active' : '' }}" aria-current="page" href="/dashboard">
            <span data-feather="home" class="align-text-bottom"></span>
            Dashboard
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link  {{ Request::is('dashboard/pilihan*') ? 'active' : '' }}" href="/dashboard/pilihan">
            <span data-feather="file" class="align-text-bottom"></span>
            Pilihan Makeup
        </a>
        </li>
        <li class="nav-item">
        <a class="nav-link  {{ Request::is('dashboard/category*') ? 'active' : '' }}" href="/dashboard/category">
            <span data-feather="folder" class="align-text-bottom"></span>
            Categories
        </a>
        </li>
    </ul>
    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
        <span>Transaksi</span>
       </h6>
       <ul class="nav flex-column">
        <li class="nav-item"><a class="nav-link {{ Request::is('dashboard/transaksi') ? 'active' : '' }}" aria-current="page" href="/dashboard/transaksi?cancel=false">
              <span data-feather="grid" class="align-text-bottom"></span>
              Transaksi
            </a>
        </li>
        <li class="nav-item"><a class="nav-link {{ Request::is('dashboard/analis') ? 'active' : '' }}" aria-current="page" href="/dashboard/analis">
              <span data-feather="trending-up" class="align-text-bottom"></span>
                Analisa Transaksi
            </a>
        </li>
       </ul>
    </div>
</nav>
         