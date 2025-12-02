<ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
  @if($recent->isEmpty())
    <li class="notification-item text-center text-muted small py-2">
      Tidak ada notifikasi
    </li>
  @else
    @foreach($recent as $notif)
      <li class="notification-item">
        <a href="{{ route('user.notification.detail', $notif->id) }}" 
        class="text-decoration-none text-dark">
          <i class="bi bi-info-circle text-primary"></i>
          <div>
            <h6>{{ $notif->message }}</h6>
            <small class="text-muted">{{ $notif->sent_at->diffForHumans() }}</small>
          </div>
        </a>
      </li>

      @if(!$loop->last)
        <li><hr class="dropdown-divider"></li>
      @endif
    @endforeach

    <li><hr class="dropdown-divider"></li>
    <li class="dropdown-footer text-center">
      <a href="{{ route('user.notifications') }}">Lihat semua notifikasi</a>
    </li>
  @endif
</ul>
