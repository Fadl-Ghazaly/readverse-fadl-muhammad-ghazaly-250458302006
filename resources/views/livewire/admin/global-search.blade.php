<div>
<div class="position-relative">

  <input type="text"
         class="form-control"
         placeholder="Cari apa saja..."
         wire:model.debounce.500ms="query"
         wire:keydown.enter="search">

  @if(!empty($results))
    <div class="dropdown-menu show p-2 w-100">

      {{-- Novel --}}
      @if(!empty($results['novels']))
        <small class="text-muted ms-2">Novel</small>
        @foreach ($results['novels'] as $n)
          <a href="{{ route('admin.novels') }}" class="dropdown-item">
            📘 {{ $n->title }}
          </a>
        @endforeach
        <hr>
      @endif

      {{-- Episode --}}
      @if(!empty($results['episodes']))
        <small class="text-muted ms-2">Episode</small>
        @foreach ($results['episodes'] as $e)
          <a href="{{ route('admin.episodes') }}" class="dropdown-item">
            🎬 {{ $e->judul }}
          </a>
        @endforeach
        <hr>
      @endif

      {{-- Genre --}}
      @if(!empty($results['genres']))
        <small class="text-muted ms-2">Genre</small>
        @foreach ($results['genres'] as $g)
          <a href="{{ route('admin.genres') }}" class="dropdown-item">
            🏷 {{ $g->nama }}
          </a>
        @endforeach
        <hr>
      @endif

      {{-- Komentar --}}
      @if(!empty($results['comments']))
        <small class="text-muted ms-2">Komentar</small>
        @foreach ($results['comments'] as $c)
          <a href="{{ route('admin.comments') }}" class="dropdown-item">
            💬 {{ Str::limit($c->comment, 30) }}
          </a>
        @endforeach
      @endif

    </div>
  @endif

</div>
