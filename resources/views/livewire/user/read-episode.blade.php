<div>
<div class="pagetitle">
  <h1>{{ $episode->judul }}</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('user.homepage') }}">Home</a></li>
      <li class="breadcrumb-item active">Episode</li>
    </ol>
  </nav>
</div>

<a href="{{ route('user.novel', [
        'slug' => $episode->novel->slug,
        'episodeNumber' => $episode->episode_number
    ]) }}" class="btn btn-primary btn-sm">
      <i class="bi bi-chevron-left"></i>
    </a>

<section class="section">
  <div class="row">
    <div class="col-lg-12">
      <div class="card">
        <div class="card-body">
          @if ($episode->file_path)
            <div class="pdf-container">
              <embed src="{{ asset('storage/' . $episode->file_path) }}#toolbar=0" 
              type="application/pdf" class="pdf-reader" />
            </div>
          @else
            {!! nl2br(e($episode->deskripsi)) !!}
          @endif
        </div>
      </div>

      <div class="mt-4">
        @livewire('user.report-form', [
            'targetType' => 'episode',
            'targetId' => $episode->id
        ])
      </div>
    </div>
  </div>
</section>

<style>
  .pdf-container {
    width: 100%;
    height: 85vh;
    border-radius: 8px;
    border: 1px solid #ddd;
    overflow: hidden;
  }
  .pdf-reader {
    width: 100%;
    height: 100%;
    border: none;
  }
</style>
</div>
