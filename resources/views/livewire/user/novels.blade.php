<div>
<div class="pagetitle">
  <h1>Daftar Novel</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('user.homepage') }}">Home</a></li>
      <li class="breadcrumb-item active">Novel</li>
    </ol>
  </nav>
</div>

<a href="{{ route('user.homepage') }}" class="btn btn-primary mb-3">
  <i class="bi bi-chevron-left"></i>
</a>

<section class="section">
  <div class="row">
    @forelse($novels as $novel)
      <div class="col-md-4">
        <div class="card">
          @if($novel->cover_image)
            <img src="{{ asset('storage/' . $novel->cover_image) }}" class="card-img-top" 
            alt="{{ $novel->title }}" style="height: 250px; object-fit: cover;">
          @else
            <img src="{{ asset('default-cover.jpg') }}" class="card-img-top" style="height: 250px; object-fit: cover;">
          @endif
          <div class="card-body">
            <h5 class="card-title">{{ $novel->title }}</h5>
            <p class="card-text text-muted">{{ Str::limit($novel->description, 100) }}</p>
            <a href="{{ route('user.novel', $novel->slug) }}" class="btn btn-primary w-100">
              <i class="bi bi-eye"></i> Baca
            </a>
          </div>
        </div>
      </div>
    @empty
      <div class="col-12 text-center text-muted">Belum ada novel tersedia.</div>
    @endforelse
  </div>

  <div class="mt-4">
    {{ $novels->links() }}
  </div>
</section>
</div>
