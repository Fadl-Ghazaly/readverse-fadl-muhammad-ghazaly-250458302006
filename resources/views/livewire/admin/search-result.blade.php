<div>
<div class="pagetitle">
  <h1>Hasil Pencarian: "{{ $query }}"</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
      <li class="breadcrumb-item active">Pencarian</li>
    </ol>
  </nav>
</div>

<section class="section">
  <div class="row">
    <div class="col-lg-12">

      @if(empty($novels) && empty($episodes) && empty($genres) && empty($comments) && empty($users))
        <div class="alert alert-info alert-dismissible fade show" role="alert">
          Tidak ada hasil untuk "<strong>{{ $query }}</strong>".
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @else

        {{-- Novel --}}
        @if($novels->isNotEmpty())
          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Novel</h5>
              <div class="table-responsive">
                <table class="table datatable">
                  <thead>
                    <tr>
                      <th scope="col">Judul</th>
                      <th scope="col">Penulis</th>
                      <th scope="col">Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($novels as $n)
                      <tr>
                        <td>
                          <a href="{{ route('admin.novels', $n->id) }}" class="text-decoration-none">
                            {{ $n->title }}
                          </a>
                        </td>
                        <td>{{ $n->author ?? '-' }}</td>
                        <td>
                          @if($n->status === 'active')
                            <span class="badge bg-success">Aktif</span>
                          @else
                            <span class="badge bg-secondary">Nonaktif</span>
                          @endif
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              {{ $novels->links() }}
            </div>
          </div>
        @endif
        

        {{-- Episode --}}
        @if($episodes->isNotEmpty())
          <div class="card mt-4">
            <div class="card-body">
              <h5 class="card-title">Episode</h5>
              <div class="table-responsive">
                <table class="table datatable">
                  <thead>
                    <tr>
                      <th scope="col">Judul</th>
                      <th scope="col">Novel</th>
                      <th scope="col">Nomor</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($episodes as $e)
                      <tr>
                        <td>
                          <a href="{{ route('admin.episodes', $e->id) }}" class="text-decoration-none">
                            {{ $e->judul }}
                          </a>
                        </td>
                        <td>
                          <a href="{{ route('admin.novels', $e->novel->id) }}" class="text-decoration-none">
                            {{ $e->novel->title }}
                          </a>
                        </td>
                        <td>{{ $e->episode_number }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              {{ $episodes->links() }}
            </div>
          </div>
        @endif

        {{-- Genre --}}
        @if($genres->isNotEmpty())
          <div class="card mt-4">
            <div class="card-body">
              <h5 class="card-title">Genre</h5>
              <div class="table-responsive">
                <table class="table datatable">
                  <thead>
                    <tr>
                      <th scope="col">Nama</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($genres as $g)
                      <tr>
                        <td>
                          <a href="{{ route('admin.genres', $g->id) }}" class="text-decoration-none">
                            {{ $g->nama }}
                          </a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              {{ $genres->links() }}
            </div>
          </div>
        @endif

        {{-- Komentar --}}
        @if($comments->isNotEmpty())
          <div class="card mt-4">
            <div class="card-body">
              <h5 class="card-title">Komentar</h5>
              <div class="table-responsive">
                <table class="table datatable">
                  <thead>
                    <tr>
                      <th scope="col">Komentar</th>
                      <th scope="col">User</th>
                      <th scope="col">Novel</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($comments as $c)
                      <tr>
                        <td>{{ \Illuminate\Support\Str::limit($c->comment, 50) }}</td>
                        <td>{{ $c->user->name ?? 'Unknown' }}</td>
                        <td>
                          @if($c->novel)
                            <a href="{{ route('admin.novels', $c->novel->id) }}" class="text-decoration-none">
                              {{ $c->novel->title }}
                            </a>
                          @else
                            <em>Novel dihapus</em>
                          @endif
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              {{ $comments->links() }}
            </div>
          </div>
        @endif

        {{-- User --}}
        @if($users->isNotEmpty())
          <div class="card mt-4">
            <div class="card-body">
              <h5 class="card-title">User</h5>
              <div class="table-responsive">
                <table class="table datatable">
                  <thead>
                    <tr>
                      <th scope="col">Nama</th>
                      <th scope="col">Email</th>
                      <th scope="col">Role</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($users as $u)
                      <tr>
                        <td>{{ $u->name }}</td>
                        <td>{{ $u->email }}</td>
                        <td>{{ ucfirst($u->role) }}</td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              {{ $users->links() }}
            </div>
          </div>
        @endif

      @endif
    </div>
  </div>
</section>