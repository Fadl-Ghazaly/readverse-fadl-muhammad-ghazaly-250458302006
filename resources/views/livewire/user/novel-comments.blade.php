<div>

    {{-- Form Komentar Utama --}}
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title">Komentar & Diskusi</h5>

            @if($replyTo)
                <div class="alert alert-info mb-3">
                    Membalas: <strong>{{ $replyTo->user->name }}</strong>
                    <button wire:click="cancelReply" class="btn btn-sm btn-danger float-end">Batal</button>
                </div>
            @endif

            <textarea
                wire:model="commentText"
                class="form-control mb-2"
                rows="3"
                placeholder="{{ $replyTo ? 'Tulis balasan...' : 'Tulis komentar...' }}"
            ></textarea>
            @error('commentText') <div class="text-danger">{{ $message }}</div> @enderror

            <button wire:click="addComment" class="btn btn-primary">
                <i class="bi bi-send"></i> {{ $replyTo ? 'Balas' : 'Kirim' }}
            </button>
        </div>
    </div>

    {{-- Daftar Komentar --}}
    <div class="card">
        <div class="card-body">
            @if($comments->isEmpty())
                <p class="text-muted">Belum ada komentar. Jadilah yang pertama!</p>
            @else
                @foreach ($comments as $comment)
                    <div class="border rounded p-3 mb-4">
                        {{-- Komentar Utama --}}
                        <div class="d-flex justify-content-between">
                            <strong>{{ $comment->user->name }}</strong>
                            <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                        </div>
                        <p class="mt-2 mb-2">{{ $comment->comment }}</p>

                        {{-- Like & Aksi --}}
                        <div class="mt-2">
                            <button wire:click="toggleLike({{ $comment->id }})" 
                            class="btn btn-sm {{ $comment->likes->isNotEmpty() ? 'btn-primary' : 'btn-outline-primary' }}">
                                <i class="bi bi-hand-thumbs-up"></i>
                                {{ $comment->likes()->count() }}
                            </button>

                            <button wire:click="setReply({{ $comment->id }})" class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-reply"></i> Balas
                            </button>

                            <button wire:click="openReport({{ $comment->id }})" class="btn btn-sm btn-outline-warning">
                                <i class="bi bi-flag"></i> Laporkan
                            </button>

                            @if(auth()->user()->role === 'admin' || $comment->user_id === auth()->id())
                                <button wire:click="deleteComment({{ $comment->id }})" 
                                class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus komentar ini?')">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            @endif
                        </div>

                        {{-- Form Laporan --}}
                        @if($showReportForm === $comment->id)
                            <div class="mt-3 p-3 bg-light rounded">
                                <h6 class="mb-2">Laporkan Komentar</h6>
                                <form wire:submit.prevent="submitReport({{ $comment->id }})">
                                    <div class="mb-2">
                                        <select wire:model="reportKategori.{{ $comment->id }}" class="form-select form-select-sm">
                                            <option value="">Pilih alasan</option>
                                            <option>Pelanggaran Aturan</option>
                                            <option>Konten Tidak Pantas</option>
                                            <option>Spam</option>
                                            <option>Lainnya</option>
                                        </select>
                                    </div>
                                    <div class="mb-2">
                                        <textarea wire:model="reportDeskripsi.{{ $comment->id }}"
                                         class="form-control form-control-sm" rows="2" placeholder="Detail laporan"></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-sm btn-danger">Kirim Laporan</button>
                                    <button type="button" wire:click="closeReport" class="btn btn-sm btn-secondary">Batal</button>
                                </form>
                            </div>
                        @endif

                        {{-- Balasan --}}
                        @if($comment->replies->isNotEmpty())
                            <div class="mt-3 ms-4">
                                @foreach($comment->replies as $reply)
                                    <div class="border rounded p-2 mb-2">
                                        <div class="d-flex justify-content-between">
                                            <strong>{{ $reply->user->name }}</strong>
                                            <small class="text-muted">{{ $reply->created_at->diffForHumans() }}</small>
                                        </div>
                                        <p class="mt-1 mb-1">{{ $reply->comment }}</p>

                                        <div class="mt-1">
                                            <button wire:click="toggleLike({{ $reply->id }})" 
                                            class="btn btn-sm {{ $reply->likes->isNotEmpty() ? 'btn-primary' : 'btn-outline-primary' }}">
                                                <i class="bi bi-hand-thumbs-up"></i>
                                                {{ $reply->likes()->count() }}
                                            </button>

                                            <button wire:click="openReport({{ $reply->id }})" class="btn btn-sm btn-outline-warning">
                                                <i class="bi bi-flag"></i> Laporkan
                                            </button>

                                            @if(auth()->user()->role === 'admin' || $reply->user_id === auth()->id())
                                                <button wire:click="deleteComment({{ $reply->id }})" 
                                                class="btn btn-sm btn-outline-danger" onclick="return confirm('Hapus balasan ini?')">
                                                    <i class="bi bi-trash"></i> Hapus
                                                </button>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                @endforeach

                {{ $comments->links() }}
            @endif
        </div>
    </div>

</div>