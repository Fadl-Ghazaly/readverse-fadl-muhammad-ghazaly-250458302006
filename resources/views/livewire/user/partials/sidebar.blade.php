<aside id="sidebar" class="sidebar">
  <ul class="sidebar-nav" id="sidebar-nav">
    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('user.homepage') ? '' : 'collapsed' }}" href="{{ route('user.homepage') }}">
        <i class="bi bi-grid"></i>
        <span>Home</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('user.novels') ? '' : 'collapsed' }}" href="{{ route('user.novels') }}">
        <i class="bi bi-book"></i>
        <span>Novels</span>
      </a>
    </li>

    <li class="nav-item">
      <a class="nav-link {{ request()->routeIs('user.bookmarks') ? '' : 'collapsed' }}" href="{{ route('user.bookmarks') }}">
        <i class="bi bi-bookmarks"></i>
        <span>Bookmarks</span>
      </a>
    </li>

   
  </ul>
</aside>