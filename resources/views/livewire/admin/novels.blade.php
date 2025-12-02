<div class="novels-page">

    {{-- Page Title --}}
    <div class="pagetitle">
        <h1>Kelola Novel</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Kelola Novel</li>
            </ol>
        </nav>
    </div>
    <!-- End Page Title -->

    {{-- Tombol Kembali --}}
    <a href="{{ route('dashboard') }}" class="btn btn-primary mb-3">
        <i class="bi bi-chevron-left"></i>
    </a>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">

                        {{-- Alert --}}
                        @if (session()->has('message'))
                            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                                {{ session('message') }}
                                <button type="button" class="btn-close"
                                        data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endif

                      

                        {{-- Form Tambah / Edit --}}
                        @if (!$isEdit)
                            @include('livewire.admin.novels-form')
                        @else
                            @include('livewire.admin.novels-edit')
                        @endif

                        <hr class="my-4">

                          {{-- Search --}}
                        <div class="mb-3 mt-4">
                            <input type="text" class="form-control"
                                   placeholder="Cari novel..."
                                   wire:model.live="search">
                        </div>

                        {{-- Table --}}
                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Judul</th>
                                        <th>Status</th>
                                        <th>Penulis</th>
                                        <th>Genre</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @forelse ($novels as $index => $novel)
                                        <tr>
                                            <td>{{ $novels->firstItem() + $index }}</td>

                                            <td>{{ $novel->title }}</td>

                                            <td>
                                                @if($novel->status === 'active')
                                                    <span class="badge bg-success">Aktif</span>
                                                @else
                                                    <span class="badge bg-danger">Nonaktif</span>
                                                @endif
                                            </td>

                                            <td>{{ $novel->author ?? 'Tidak diketahui' }}</td>

                                     <td>
    @if($novel->relationLoaded('genres') && $novel->genres->isNotEmpty())
        @foreach($novel->genres as $genre)
            <span class="badge bg-primary me-1">{{ $genre->nama }}</span>
        @endforeach
    @else
        <span class="text-muted">-</span>
    @endif
</td>

                                            <td>
                                                <button class="btn btn-outline-primary btn-sm me-1"
                                                        wire:click="edit({{ $novel->id }})">
                                                    <i class="bi bi-pencil"></i>
                                                </button>

                                                <button class="btn btn-outline-danger btn-sm"
                                                        onclick="if (confirm('Yakin hapus novel ini?')) @this.delete({{ $novel->id }})">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </td>
                                        </tr>

                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-muted">
                                                Tidak ada novel.
                                            </td>
                                        </tr>
                                    @endforelse

                                </tbody>
                            </table>
                        </div>

                        {{-- Pagination --}}
                        <div class="mt-3">
                            {{ $novels->links() }}
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

</div>
