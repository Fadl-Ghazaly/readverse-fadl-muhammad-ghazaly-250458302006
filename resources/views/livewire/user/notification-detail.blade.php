<div> 
<div class="pagetitle">
  <h1>Detail Notifikasi</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('user.homepage') }}">Home</a></li>
      <li class="breadcrumb-item"><a href="{{ route('user.notifications') }}">Notifikasi</a></li>
      <li class="breadcrumb-item active">Detail</li>
    </ol>
  </nav>
</div>

<a href="{{ route('user.notifications') }}" class="btn btn-primary mb-3">
  <i class="bi bi-chevron-left"></i>
</a>

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <div class="card">
        <div class="card-body">

          <h5 class="card-title">{{ $notification->message }}</h5>
          <p class="text-muted">{{ $notification->sent_at->format('d M Y H:i') }}</p>

          @if($notification->data)
            <pre class="bg-light p-3 rounded">
{{ json_encode($notification->data, JSON_PRETTY_PRINT) }}
            </pre>
          @endif

          <div class="mt-3">
            <a href="{{ route('user.notifications') }}" class="btn btn-secondary">Kembali ke Daftar</a>

            <button wire:click="delete" class="btn btn-danger">
              <i class="bi bi-trash"></i> Hapus
            </button>
          </div>

        </div>
      </div>

    </div>
  </div>
</section>
