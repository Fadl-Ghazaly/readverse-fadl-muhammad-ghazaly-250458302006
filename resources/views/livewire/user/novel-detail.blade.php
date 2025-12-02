<div>
<div class="pagetitle">
  <h1>{{ $novel->title }}</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('user.homepage') }}">Home</a></li>
      <li class="breadcrumb-item active">Novel</li>
    </ol>
  </nav>
</div>

<a href="{{ route('user.novels') }}" class="btn btn-sm btn-outline-secondary mb-3">
  <i class="bi bi-chevron-left"></i> Kembali ke Daftar
</a>

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      <!-- Card Utama Novel -->
      <div class="card">
        <div class="card-body">
          <p>{{ $novel->description }}</p>

          <!-- Genre -->
          <div class="mt-3">
            <strong>Genre:</strong>
            @if($novel->genres->isNotEmpty())
              @foreach($novel->genres as $genre)
                <span class="badge bg-primary me-1">{{ $genre->nama }}</span>
              @endforeach
            @else
              <span class="text-muted">Tidak ada genre</span>
            @endif
          </div>
        </div>

        <div class="card-footer bg-white d-flex justify-content-between align-items-center">
          <small class="text-muted">
            Rating:
            @if($totalRatings > 0)
              {{ $averageRating }}/5 ({{ $totalRatings }} ulasan)
            @else
              Belum ada rating
            @endif
          </small>

          <!-- Tombol Aksi -->
          <div class="d-flex gap-2">
            <button wire:click="toggleBookmark" class="btn btn-sm btn-primary">
              @if ($isBookmarked)
                <i class="bi bi-bookmark-fill"></i> Tersimpan
              @else
                <i class="bi bi-bookmark"></i> Simpan
              @endif
            </button>

            <button wire:click="toggleLike" class="btn btn-sm {{ $isLiked ? 'btn-danger' : 'btn-outline-danger' }}">
              <i class="bi bi-heart-fill"></i> {{ $likeCount }}
            </button>

            @if($userRating > 0)
              <span class="btn btn-sm btn-warning" disabled>
                <i class="bi bi-star"></i> {{ $userRating }}/5
              </span>
            @else
              <button wire:click="$set('showRatingForm', true)" class="btn btn-sm btn-warning">
                <i class="bi bi-star"></i> Rating
              </button>
            @endif

            <a href="#reportForm" class="btn btn-sm btn-danger">
              <i class="bi bi-flag"></i> Laporkan
            </a>
          </div>
        </div>
      </div>

      <!-- Form Rating -->
      @if($showRatingForm)
        <div class="card mt-3">
          <div class="card-body">
            <h6 class="mb-2">Beri Rating untuk Novel Ini</h6>
            <div class="btn-group" role="group">
              @for($i = 1; $i <= 5; $i++)
                <button type="button"
                        wire:click="submitRating({{ $i }})"
                        class="btn btn-sm {{ $userRating == $i ? 'btn-warning' : 'btn-outline-warning' }}">
                  {{ $i }} <i class="bi bi-star"></i>
                </button>
              @endfor
            </div>
          </div>
        </div>
      @endif

      <!-- Alert -->
      @if (session()->has('bookmarkMessage'))
        <div class="alert alert-info alert-dismissible fade show mt-3" role="alert">
          {{ session('bookmarkMessage') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      <!-- Daftar Episode -->
      <div class="card mt-4">
        <div class="card-header">
          <h6 class="mb-0">Daftar Episode</h6>
        </div>
        <div class="card-body p-0">
          <ul class="list-group list-group-flush">
            @foreach ($episodes as $episode)
              <li class="list-group-item d-flex justify-content-between align-items-center">
                <span>Episode {{ $episode->episode_number }}: {{ $episode->judul }}</span>
                <a href="{{ route('user.episode', [$novel->slug, $episode->episode_number]) }}" class="btn btn-sm btn-primary">
                  <i class="bi bi-book"></i> Baca
                </a>
              </li>
            @endforeach
          </ul>
        </div>
      </div>

      <!-- Form Laporan -->
      <div id="reportForm" class="card mt-4">
        <div class="card-header">
          <h6 class="mb-0">Laporkan Novel</h6>
        </div>
        <div class="card-body">
          @livewire('user.report-form', [
              'targetType' => 'novel',
              'targetId' => $novel->id
          ])
        </div>
      </div>

      <!-- Komentar -->
      <div class="card mt-4">
        <div class="card-header">
          <h6 class="mb-0">Komentar & Diskusi</h6>
        </div>
        <div class="card-body p-0">
          @livewire('user.novel-comments', ['novel' => $novel])
        </div>
      </div>

    </div>
  </div>
</section>