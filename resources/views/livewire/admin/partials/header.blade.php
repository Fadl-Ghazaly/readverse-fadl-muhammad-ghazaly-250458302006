<header id="header" class="header fixed-top d-flex align-items-center">
  <div class="d-flex align-items-center justify-content-between">
    <a href="{{ route('dashboard') }}" class="logo d-flex align-items-center">
      <img src="{{ asset('NiceAdmin/assets/img/Logo1.png') }}" alt="">
      <span class="d-none d-lg-block">Readverse</span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
  </div><!-- End Logo -->

 <div class="search-bar">
  @livewire('admin.search')
</div><!-- End Search Bar -->

  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">

      <li class="nav-item d-block d-lg-none">
        <a class="nav-link nav-icon search-bar-toggle" href="#">
          <i class="bi bi-search"></i>
        </a>
      </li><!-- End Search Icon-->

      <!-- Notification -->
      <li class="nav-item dropdown">
        <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
          <i class="bi bi-bell"></i>
          <span class="badge bg-primary badge-number">0</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
          <li class="dropdown-header">
            Tidak ada notifikasi baru
          </li>
          <li><hr class="dropdown-divider"></li>
          <li class="dropdown-footer">
            <a href="#">Lihat semua notifikasi</a>
          </li>
        </ul>
      </li><!-- End Notification Nav -->

      <!-- Profile -->
      <li class="nav-item dropdown pe-3">
        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
           <img src="{{ asset('storage/'.auth()->user()->profile_photo) }}" alt="Profile" class="rounded-circle">
          <span class="d-none d-md-block ps-2">{{ auth()->user()->name }}</span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          <li class="dropdown-header">
            <h6>{{ auth()->user()->name }}</h6>
            <span class="text-muted text-capitalize">{{ auth()->user()->role }}</span>
          </li>
          <li><hr class="dropdown-divider"></li>
          <li>
            <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.profile') }}">
              <i class="bi bi-person"></i>
              <span>Profil Saya</span>
            </a>
          </li>
          <li><hr class="dropdown-divider"></li>
          <li>
            <form action="{{ route('logout') }}" method="POST" class="d-block">
              @csrf
              <button type="submit" class="dropdown-item d-flex align-items-center text-danger">
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
              </button>
            </form>
          </li>
        </ul>
      </li><!-- End Profile Nav -->

    </ul>
  </nav><!-- End Icons Navigation -->
</header>