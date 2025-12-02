<div>
<div class="pagetitle">
  <h1>Bookmark Saya</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('user.homepage') }}">Home</a></li>
      <li class="breadcrumb-item active">Bookmark</li>
    </ol>
  </nav>
</div>

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      {{-- Form Tambah Bookmark --}}
      <div class="card mb-4">
        <div class="card-body">
          <form wire:submit.prevent="addBookmark" class="row g-3">
            <div class="col-md-8">
              <label for="novel" class="form-label">Pilih Novel</label>
              <select wire:model="selectedNovel" id="novel" class="form-select">
                <option value="">-- Pilih Novel --</option>
                @foreach($novels as $novel)
                  <option value="{{ $novel->id }}">{{ $novel->title }}</option>
                @endforeach
              </select>
            </div>
            <div class="col-md-4 d-flex align-items-end">
              <button type="submit" class="btn btn-primary">Tambah ke Bookmark</button>
            </div>
          </form>
        </div>
      </div>

      {{-- Daftar Bookmark --}}
      <div class="row">
        @forelse($bookmarks as $bookmark)
          @php $novel = $bookmark->novel; @endphp
          @if($novel)
            <div class="col-lg-4 col-md-6">
              <div class="card mb-4">
                @if($novel->cover_image)
                  <img src="{{ asset('storage/'.$novel->cover_image) }}" class="card-img-top" 
                  style="height: 250px; object-fit: cover;" alt="{{ $novel->title }}">
                @else
                  <div class="card-img-top d-flex align-items-center justify-content-center bg-light" style="height: 250px;">
                    <i class="bi bi-book text-muted" style="font-size: 3rem;"></i>
                  </div>
                @endif

                <div class="card-body">
                  <h5 class="card-title">{{ $novel->title }}</h5>
                  <p class="card-text text-muted">{{ Str::limit($novel->description, 100) }}</p>
                  <a href="{{ route('user.novel', $novel->slug) }}" class="btn btn-primary btn-sm">
                    <i class="bi bi-eye"></i> Lihat
                  </a>

                  <button wire:click="removeBookmark({{ $bookmark->id }})" class="btn btn-outline-danger btn-sm mt-2">
                    <i class="bi bi-trash"></i> Hapus
                  </button>
                </div>
              </div>
            </div>
          @endif
        @empty
          <div class="col-12">
            <div class="text-center text-muted">Belum ada novel yang disimpan.</div>
          </div>
        @endforelse
      </div>

      <div class="mt-4">
        {{ $bookmarks->links('vendor.livewire.custom-pagination') }}
      </div>

    </div>
  </div>
</section>
</div>
