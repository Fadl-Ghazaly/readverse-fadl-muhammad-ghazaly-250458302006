<div>

    <div class="pagetitle">
        <h1>Kirim Notifikasi</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Notifikasi</li>
            </ol>
        </nav>
    </div>

    <a href="{{ route('dashboard') }}" class="btn btn-primary mb-3">
        <i class="bi bi-chevron-left"></i>
    </a>

    <section class="section">
        <div class="row">
            <div class="col-lg-8">

                <div class="card">
                    <div class="card-body">

                        <h5 class="card-title">Form Kirim Notifikasi</h5>

                        @if (session()->has('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                            </div>
                        @endif

                        <!-- Penerima -->
                        <div class="mb-3">
                            <label class="form-label">Penerima</label>
                            <select wire:model="user_id" class="form-select">
                                <option value="all">Semua User</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}">
                                        {{ $user->name }} ({{ $user->email }})
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Tipe Notifikasi -->
                        <div class="mb-3">
                            <label class="form-label">Tipe Notifikasi</label>
                            <input type="text" wire:model="type" class="form-control"
                                   placeholder="Misal: system, novel_update">
                        </div>

                        <!-- Pesan -->
                        <div class="mb-3">
                            <label class="form-label">Pesan</label>
                            <textarea wire:model="message" class="form-control" rows="3"
                                      placeholder="Isi notifikasi..."></textarea>
                        </div>

                        <button wire:click="send" class="btn btn-primary">
                            <i class="bi bi-send"></i> Kirim Notifikasi
                        </button>

                    </div>
                </div>

            </div>
        </div>
    </section>

</div>
