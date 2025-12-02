<aside id="sidebar" class="sidebar">
    <ul class="sidebar-nav" id="sidebar-nav">

        <!-- Dashboard -->
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('dashboard') ? '' : 'collapsed' }}"
               href="{{ route('dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <!-- Novel -->
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.novels') ? '' : 'collapsed' }}"
               href="{{ route('admin.novels') }}">
                <i class="bi bi-book"></i>
                <span>Novel</span>
            </a>
        </li>

        <!-- Episode -->
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.episodes') ? '' : 'collapsed' }}"
               href="{{ route('admin.episodes') }}">
                <i class="bi bi-collection"></i>
                <span>Episode</span>
            </a>
        </li>

        <!-- Genre -->
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.genres') ? '' : 'collapsed' }}"
               href="{{ route('admin.genres') }}">
                <i class="bi bi-tags"></i>
                <span>Genre</span>
            </a>
        </li>

        <!-- Komentar -->
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.comments') ? '' : 'collapsed' }}"
               href="{{ route('admin.comments') }}">
                <i class="bi bi-chat-dots"></i>
                <span>Komentar</span>
            </a>
        </li>

        <!-- Laporan -->
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.reports') ? '' : 'collapsed' }}"
               href="{{ route('admin.reports') }}">
                <i class="bi bi-flag"></i>
                <span>Laporan</span>
            </a>
        </li>

        <!-- Notifikasi -->
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('admin.notifications') ? '' : 'collapsed' }}"
               href="{{ route('admin.notifications') }}">
                <i class="bi bi-bell"></i>
                <span>Notifikasi</span>
            </a>
        </li>

       

    </ul>
</aside>