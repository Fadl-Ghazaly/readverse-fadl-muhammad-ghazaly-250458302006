<header id="header" class="header fixed-top d-flex align-items-center">
  <div class="d-flex align-items-center justify-content-between">
    <a href="{{ route('user.homepage') }}" class="logo d-flex align-items-center">
      <img src="{{ asset('NiceAdmin/assets/img/Logo1.png') }}" alt="">
      <span class="d-none d-lg-block">Readverse</span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn"></i>
  </div>

  <div class="search-bar">
    <form class="search-form d-flex align-items-center" method="GET" action="{{ route('user.search-results') }}">
      <input type="text" name="q" placeholder="Search" title="Enter search keyword">
      <button type="submit" title="Search"><i class="bi bi-search"></i></button>
    </form>
  </div>

  <nav class="header-nav ms-auto">
    <ul class="d-flex align-items-center">

      <li class="nav-item d-block d-lg-none">
        <a class="nav-link nav-icon search-bar-toggle" href="#">
          <i class="bi bi-search"></i>
        </a>
      </li>

      <!-- Notification -->
      <li class="nav-item dropdown">
        <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
          <i class="bi bi-bell"></i>
          @php($unread = \App\Models\Notification::forUser(auth()->id())->where('is_read', false)->count())
          @if($unread > 0)
            <span class="badge bg-primary badge-number">{{ $unread }}</span>
          @endif
        </a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
          <li class="dropdown-header">
            Notifikasi
            <a href="{{ route('user.notifications') }}"><span class="badge rounded-pill bg-primary p-2 ms-2">Lihat Semua</span></a>
          </li>
          <li><hr class="dropdown-divider"></li>
          <li class="notification-item text-center text-muted small py-2">
            Tidak ada notifikasi baru
          </li>
          <li><hr class="dropdown-divider"></li>
          <li class="dropdown-footer">
            <a href="{{ route('user.notifications') }}">Tampilkan semua notifikasi</a>
          </li>
        </ul>
      </li>

      <!-- Profile -->
      <li class="nav-item dropdown pe-3">
        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
           <img src="{{ asset('storage/'.auth()->user()->profile_photo) }}" alt="Profile" class="rounded-circle">
        </a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
          <li class="dropdown-header">
            <h6>{{ auth()->user()->name }}</h6>
            <span class="text-muted">{{ ucfirst(auth()->user()->role) }}</span>
          </li>
          <li><hr class="dropdown-divider"></li>
          <li>
            <a class="dropdown-item" href="{{ route('user.profiles') }}">
              <i class="bi bi-person"></i>
              <span>Profil Saya</span>
            </a>
          </li>
          <li><hr class="dropdown-divider"></li>
          <li>
            <form action="{{ route('logout') }}" method="POST" class="d-block">
              @csrf
              <button type="submit" class="dropdown-item text-danger">
                <i class="bi bi-box-arrow-right"></i>
                <span>Logout</span>
              </button>
            </form>
          </li>
        </ul>
      </li>

    </ul>
  </nav>
</header>