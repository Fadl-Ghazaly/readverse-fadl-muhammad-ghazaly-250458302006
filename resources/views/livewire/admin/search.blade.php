<div class="position-relative">
  <input
    type="text"
    class="form-control"
    placeholder="Cari di seluruh sistem..."
    wire:model.debounce.500ms="query"
    wire:keydown.enter="redirectToResults"
    style="height: 38px; font-size: 14px;"
  />

  @if(!empty($results))
    <div class="dropdown-menu show w-100 mt-1 shadow"
         style="position: absolute; top: 100%; max-height: 400px; overflow-y: auto;">

      {{-- Novel --}}
      @if(!empty($results['novels']))
        <small class="text-muted ms-2">Novel</small>
        @foreach($results['novels'] as $n)
          <a href="{{ route('admin.novels') }}" class="dropdown-item py-2">📘 {{ $n->title }}</a>
        @endforeach
        <hr>
      @endif

      {{-- Episode --}}
      @if(!empty($results['episodes']))
        <small class="text-muted ms-2">Episode</small>
        @foreach($results['episodes'] as $e)
          <a href="{{ route('admin.episodes') }}" class="dropdown-item py-2">
            🎬 Ep {{ $e->episode_number }} — {{ Str::limit($e->judul, 30) }}
          </a>
        @endforeach
        <hr>
      @endif

      {{-- Genre --}}
      @if(!empty($results['genres']))
        <small class="text-muted ms-2">Genre</small>
        @foreach($results['genres'] as $g)
          <a href="{{ route('admin.genres') }}" class="dropdown-item py-2">🏷️ {{ $g->nama }}</a>
        @endforeach
        <hr>
      @endif

      {{-- Komentar --}}
      @if(!empty($results['comments']))
        <small class="text-muted ms-2">Komentar</small>
        @foreach($results['comments'] as $c)
          <a href="{{ route('admin.comments') }}" class="dropdown-item py-2">
            💬 {{ Str::limit($c->comment, 30) }} — {{ $c->user->name }}
          </a>
        @endforeach
        <hr>
      @endif

      {{-- User --}}
      @if(!empty($results['users']))
        <small class="text-muted ms-2">User</small>
        @foreach($results['users'] as $u)
          <a href="#" class="dropdown-item py-2">👤 {{ $u->name }}</a>
        @endforeach
      @endif

      <li class="text-center py-1">
        <a href="{{ route('admin.search-result', ['q' => $query]) }}" class="small text-primary">Lihat Semua Hasil</a>
      </li>

    </div>
  @endif
</div>
