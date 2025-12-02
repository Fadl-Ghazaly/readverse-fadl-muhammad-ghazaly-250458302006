<div>
  <div class="pagetitle">
    <h1>Novel Tersedia</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('user.homepage') }}">Home</a></li>
        <li class="breadcrumb-item active">Novel</li>
      </ol>
    </nav>
  </div>

  <section class="section">
    <div class="row">
      
      @forelse($novels as $novel)
        <div class="col-lg-4 col-md-6">
          <div class="card">
            
            @if($novel->cover_image)
              <img src="{{ asset('storage/'.$novel->cover_image) }}"
                   class="card-img-top"
                   style="height: 250px; object-fit: cover;"
                   alt="{{ $novel->title }}">
            @endif

            <div class="card-body">
              <h5 class="card-title">{{ $novel->title }}</h5>
              <p class="card-text text-muted">
                {{ Str::limit($novel->description, 100) }}
              </p>
              <a href="{{ route('user.novel', $novel->slug) }}" class="btn btn-primary">
                <i class="bi bi-eye"></i> Lihat
              </a>
            </div>

          </div>
        </div>
      @empty
        <div class="col-12">
          <div class="text-center text-muted">Belum ada novel tersedia.</div>
        </div>
      @endforelse

    </div>

    <div class="mt-4">
      {{ $novels->links('vendor.livewire.custom-pagination') }}
    </div>
  </section>
</div>
