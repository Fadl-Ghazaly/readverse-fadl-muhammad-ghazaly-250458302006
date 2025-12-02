<div>

    <div class="pagetitle">
        <h1>Komentar pada Novel: {{ $novel->title }}</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.comments') }}">Komentar</a></li>
                <li class="breadcrumb-item active">Detail</li>
            </ol>
        </nav>
    </div>

    <a href="{{ route('admin.comments') }}" class="btn btn-primary mb-3">
        <i class="bi bi-chevron-left"></i>
    </a>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                {{-- Alert sukses --}}
                @if (session()->has('message'))
                    <div class="alert alert-success">{{ session('message') }}</div>
                @endif

                {{-- Mode reply --}}
                @if ($replyTo)
                    <div class="alert alert-info">
                        Membalas komentar dari <strong>{{ $replyTo->user->name }}</strong>
                        <button class="btn btn-sm btn-danger float-end" wire:click="cancelReply">
                            Batal
                        </button>
                    </div>
                @endif

                {{-- Form komentar admin --}}
                <div class="card mb-4">
                    <div class="card-body">
                        <h5 class="card-title">Tambah Komentar Admin</h5>

                        <textarea class="form-control mb-2"
                                  rows="3"
                                  placeholder="Tulis komentar sebagai admin..."
                                  wire:model.defer="commentText"></textarea>

                        <button class="btn btn-primary" wire:click="addComment">
                            <i class="bi bi-send"></i> Kirim
                        </button>
                    </div>
                </div>

                {{-- Daftar komentar --}}
                <div class="card">
                    <div class="card-body">

                        <h5 class="card-title">Semua Komentar</h5>

                        @foreach ($comments as $c)
                            <div class="border rounded p-3 mb-3">

                                <strong>{{ $c->user->name }}</strong>
                                <p class="mb-1">{{ $c->comment }}</p>
                                <small class="text-muted">{{ $c->created_at->diffForHumans() }}</small>

                                <div class="mt-2">
                                    <button class="btn btn-sm btn-outline-primary"
                                            wire:click="setReply({{ $c->id }})">
                                        <i class="bi bi-reply"></i> Balas
                                    </button>

                                    <button class="btn btn-sm btn-outline-danger"
                                            wire:click="delete({{ $c->id }})">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </div>

                                {{-- Balasan --}}
                                @foreach ($c->replies as $reply)
                                    <div class="ms-4 mt-3 border rounded p-2">
                                        <strong>{{ $reply->user->name }}</strong>
                                        <p class="mb-1">{{ $reply->comment }}</p>
                                        <small class="text-muted">{{ $reply->created_at->diffForHumans() }}</small>

                                        <div class="mt-2">
                                            <button class="btn btn-sm btn-outline-danger"
                                                    wire:click="delete({{ $reply->id }})">
                                                <i class="bi bi-trash"></i> Hapus
                                            </button>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        @endforeach

                        <div class="mt-3">
                            {{ $comments->links() }}
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>

</div>
