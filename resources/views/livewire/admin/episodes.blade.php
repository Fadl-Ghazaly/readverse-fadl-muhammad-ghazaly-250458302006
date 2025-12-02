<div>

    <div class="pagetitle">
        <h1>Kelola Episode</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Kelola Episode</li>
            </ol>
        </nav>
    </div>

    <a href="{{ route('dashboard') }}" class="btn btn-primary mb-3">
        <i class="bi bi-chevron-left"></i>
    </a>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                {{-- Alert Message --}}
                @if (session()->has('message'))
                    <div class="alert alert-success alert-dismissible fade show">
                        {{ session('message') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                @endif

                {{-- Form Episode --}}
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Form Tambah Episode</h5>

                        <form wire:submit.prevent="store" enctype="multipart/form-data">
                            <div class="row g-3">

                                <div class="col-md-6">
                                    <label class="form-label">Pilih Novel</label>
                                    <select wire:model="novel_id" class="form-select">
                                        <option value="">-- Pilih Novel --</option>
                                        @foreach($novels as $novel)
                                            <option value="{{ $novel->id }}">{{ $novel->title }}</option>
                                        @endforeach
                                    </select>
                                    @error('novel_id') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Judul Episode</label>
                                    <input type="text" wire:model="judul" class="form-control" placeholder="Masukkan judul episode">
                                    @error('judul') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Nomor Episode</label>
                                    <input type="number" wire:model="episode_number" class="form-control">
                                    @error('episode_number') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-8">
                                    <label class="form-label">Deskripsi</label>
                                    <textarea wire:model="deskripsi" rows="2" class="form-control"></textarea>
                                    @error('deskripsi') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">Cover</label>
                                    <input type="file" wire:model="cover_image" class="form-control">
                                    @error('cover_image') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label">File Episode</label>
                                    <input type="file" wire:model="file_path" class="form-control">
                                    @error('file_path') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-4">
                                    <label class="form-label">Status</label>
                                    <select wire:model="status" class="form-select">
                                        <option value="active">Aktif</option>
                                        <option value="inactive">Nonaktif</option>
                                    </select>
                                    @error('status') <div class="text-danger">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-12 text-end">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="bi bi-save"></i> Simpan Episode
                                    </button>
                                </div>

                            </div>
                        </form>

                    </div>
                </div>

                {{-- Tabel Episode --}}
                <div class="card mt-4">
                    <div class="card-body">

                        <h5 class="card-title">Daftar Episode</h5>

                        <input type="text" wire:model.live="search" class="form-control mb-3" placeholder="Cari episode...">

                        <div class="table-responsive">
                            <table class="table table-bordered">

                                <thead>
                                    <tr>
                                        <th>Novel</th>
                                        <th>Judul Episode</th>
                                        <th>No</th>
                                        <th>Status</th>
                                        <th class="text-center">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($episodes as $ep)
                                        <tr>
                                            <td>{{ $ep->novel->title }}</td>
                                            <td>{{ $ep->judul }}</td>
                                            <td>{{ $ep->episode_number }}</td>
                                            <td>
                                                @if($ep->status === 'active')
                                                    <span class="badge bg-success">Aktif</span>
                                                @else
                                                    <span class="badge bg-secondary">Nonaktif</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                <button wire:click="edit({{ $ep->id }})" class="btn btn-outline-primary btn-sm">
                                                    <i class="bi bi-pencil"></i>
                                                </button>
                                                <button wire:click="delete({{ $ep->id }})"
                                                        onclick="return confirm('Yakin ingin menghapus episode ini?')"
                                                        class="btn btn-outline-danger btn-sm">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="text-center text-muted">Belum ada episode.</td>
                                        </tr>
                                    @endforelse
                                </tbody>

                            </table>
                        </div>

                        <div class="mt-3">
                            {{ $episodes->links() }}
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

</div>
