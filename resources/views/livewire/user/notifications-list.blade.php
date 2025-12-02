<div> 
<div class="pagetitle">
  <h1>Notifikasi</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('user.homepage') }}">Home</a></li>
      <li class="breadcrumb-item active">Notifikasi</li>
    </ol>
  </nav>
</div>

<a href="{{ route('user.homepage') }}" class="btn btn-primary mb-3">
  <i class="bi bi-chevron-left"></i>
</a>

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">

          <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="card-title">Daftar Notifikasi</h5>
            <button wire:click="deleteAll" class="btn btn-outline-danger btn-sm">
              <i class="bi bi-trash"></i> Hapus Semua
            </button>
          </div>

          @if($notifications->isEmpty())
            <p class="text-center text-muted">Tidak ada notifikasi.</p>
          @else
            <ul class="list-group list-group-flush">
              @foreach($notifications as $notif)
                <li class="list-group-item d-flex justify-content-between align-items-start">
                  <div class="ms-2 me-auto">
                    <a href="{{ route('user.notification.detail', $notif->id) }}" class="text-decoration-none">
                      <div class="fw-bold">{{ $notif->message }}</div>
                      <small class="text-muted">{{ $notif->sent_at->diffForHumans() }}</small>
                    </a>
                  </div>

                  <button wire:click="delete({{ $notif->id }})" class="btn btn-outline-danger btn-sm">
                    <i class="bi bi-trash"></i>
                  </button>
                </li>
              @endforeach
            </ul>

            {{ $notifications->links() }}
          @endif

        </div>
      </div>

    </div>
  </div>
</section>
