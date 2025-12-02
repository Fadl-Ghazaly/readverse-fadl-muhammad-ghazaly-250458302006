<div>
<div class="pagetitle">
  <h1>Hasil Pencarian: "{{ $query }}"</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('user.homepage') }}">Home</a></li>
      <li class="breadcrumb-item active">Pencarian</li>
    </ol>
  </nav>
</div>

<section class="section">
  <div class="row">
    <div class="col-lg-12">
      @if($novels->isEmpty() && $episodes->isEmpty())
        <div class="alert alert-info">Tidak ada hasil untuk "<strong>{{ $query }}</strong>"</div>
      @else
        @if($novels->isNotEmpty())
          <h5 class="card-title">Novel</h5>
          <div class="row">
            @foreach($novels as $novel)
              <div class="col-lg-4">
                <div class="card">
                  <div class="card-body">
                    <h5 class="card-title">{{ $novel->title }}</h5>
                    <a href="{{ route('user.novel', $novel->slug) }}" class="btn btn-primary btn-sm">Lihat</a>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
          {{ $novels->links() }}
        @endif

        @if($episodes->isNotEmpty())
          <h5 class="card-title mt-4">Episode</h5>
          <div class="card">
            <ul class="list-group list-group-flush">
              @foreach($episodes as $e)
                <li class="list-group-item">
                  <a href="{{ route('user.episode', [$e->novel->slug, $e->episode_number]) }}">
                    🎬 Ep {{ $e->episode_number }} — {{ $e->judul }}
                  </a>
                </li>
              @endforeach
            </ul>
          </div>
          {{ $episodes->links() }}
        @endif
      @endif
    </div>
  </div>
</section>