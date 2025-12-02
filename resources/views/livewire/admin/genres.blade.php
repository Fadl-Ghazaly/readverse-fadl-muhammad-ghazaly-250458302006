<div>

    <div class="pagetitle">
        <h1>Kelola Genre</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Kelola Genre</li>
            </ol>
        </nav>
    </div>

    <a href="{{ route('dashboard') }}" class="btn btn-primary mb-3">
        <i class="bi bi-chevron-left"></i>
    </a>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">

                        <h5 class="card-title">Daftar Genre</h5>

                        {{-- Alert Notification --}}
                        @if (session()->has('message'))
                            <div class="alert alert-success alert-dismissible fade show">
                                {{ session('message') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        {{-- Form Genre --}}
                        <form wire:submit.prevent="store" class="row g-3 mb-3">

                            <div class="col-md-8">
                                <input type="text" wire:model="nama" class="form-control" placeholder="Nama Genre">
                                @error('nama') <div class="text-danger">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-4 d-flex align-items-center">
                                <button type="submit" class="btn btn-primary me-2">
                                    {{ $genre_id ? 'Perbarui' : 'Simpan' }}
                                </button>

                                @if($genre_id)
                                    <button type="button" wire:click="cancelEdit" class="btn btn-secondary">
                                        Batal
                                    </button>
                                @endif
                            </div>
                        </form>

                        {{-- Table Genre --}}
                        <div class="table-responsive">
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Genre</th>
                                        <th style="width: 15%;">Aksi</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @forelse($genres as $index => $genre)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $genre->nama }}</td>

                                            <td>
                                                <button wire:click="edit({{ $genre->id }})"
                                                        class="btn btn-outline-primary btn-sm me-1">
                                                    <i class="bi bi-pencil"></i>
                                                </button>

                                                <button wire:click="delete({{ $genre->id }})"
                                                        onclick="return confirm('Yakin ingin menghapus genre ini?')"
                                                        class="btn btn-outline-danger btn-sm">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="3" class="text-center text-muted">
                                                Belum ada data genre.
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>

                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

</div>
