<div>
    
    {{-- Main Comment Form --}}
    <div class="mb-8">
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6">
            <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
                <i class="bi bi-chat-quote-fill text-indigo-600"></i>
                Tulis Komentar
            </h3>

            @if($replyTo)
                <div class="mb-4 p-3 bg-indigo-50 border border-indigo-100 rounded-xl flex items-center justify-between animate-fade-in-down">
                    <div class="flex items-center gap-2 text-sm text-indigo-700">
                        <i class="bi bi-reply-fill"></i>
                        <span>Membalas: <strong>{{ $replyTo->user->name }}</strong></span>
                    </div>
                    <button wire:click="cancelReply" class="text-xs font-medium text-red-500 hover:text-red-700 hover:bg-red-50 px-2 py-1 rounded-lg transition-colors">
                        Batal
                    </button>
                </div>
            @endif

            <div class="relative">
                <textarea
                    wire:model="commentText"
                    class="w-full px-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent focus:bg-white transition-all resize-none text-sm"
                    rows="3"
                    placeholder="{{ $replyTo ? 'Tulis balasan Anda...' : 'Bagikan pendapat Anda tentang novel ini...' }}"
                ></textarea>
                
                <div class="flex justify-end mt-3">
                    <button wire:click="addComment" 
                            class="inline-flex items-center px-6 py-2.5 bg-indigo-600 text-white text-sm font-medium rounded-xl hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-500/30 transition-all shadow-lg shadow-indigo-500/30">
                        <i class="bi bi-send-fill mr-2"></i>
                        {{ $replyTo ? 'Kirim Balasan' : 'Kirim Komentar' }}
                    </button>
                </div>
            </div>
            
            @error('commentText') 
                <p class="mt-2 text-sm text-red-500 flex items-center gap-1">
                    <i class="bi bi-exclamation-circle"></i> {{ $message }}
                </p> 
            @enderror
        </div>
    </div>

    {{-- Comments List --}}
    <div class="space-y-6">
        @if($comments->isEmpty())
            <div class="text-center py-12 bg-white rounded-2xl border border-slate-200 border-dashed">
                <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-3">
                    <i class="bi bi-chat-dots text-2xl text-slate-400"></i>
                </div>
                <p class="text-slate-500 font-medium">Belum ada komentar</p>
                <p class="text-sm text-slate-400">Jadilah yang pertama memberikan komentar!</p>
            </div>
        @else
            @foreach ($comments as $comment)
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 transition-all hover:shadow-md">
                    <div class="flex gap-4">
                        {{-- Avatar --}}
                        <div class="flex-shrink-0">
                            @if($comment->user->profile_photo)
                                <img src="{{ asset('storage/'.$comment->user->profile_photo) }}" alt="{{ $comment->user->name }}" class="w-10 h-10 rounded-full object-cover ring-2 ring-slate-100">
                            @else
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-sm ring-2 ring-slate-100">
                                    {{ substr($comment->user->name, 0, 1) }}
                                </div>
                            @endif
                        </div>

                        {{-- Content --}}
                        <div class="flex-1 min-w-0">
                            <div class="flex items-center justify-between mb-1">
                                <h4 class="text-sm font-bold text-slate-900">{{ $comment->user->name }}</h4>
                                <span class="text-xs text-slate-500">{{ $comment->created_at->diffForHumans() }}</span>
                            </div>
                            
                            <div class="prose prose-sm max-w-none text-slate-600 mb-3">
                                <p>{{ $comment->comment }}</p>
                            </div>

                            {{-- Actions --}}
                            <div class="flex items-center gap-4 border-t border-slate-100 pt-3">
                                <button wire:click="toggleLike({{ $comment->id }})" 
                                        class="flex items-center gap-1.5 text-xs font-medium transition-colors {{ $comment->likes->isNotEmpty() ? 'text-indigo-600' : 'text-slate-500 hover:text-indigo-600' }}">
                                    <i class="bi {{ $comment->likes->isNotEmpty() ? 'bi-hand-thumbs-up-fill' : 'bi-hand-thumbs-up' }} text-sm"></i>
                                    <span>{{ $comment->likes()->count() }}</span>
                                </button>

                                <button wire:click="setReply({{ $comment->id }})" 
                                        class="flex items-center gap-1.5 text-xs font-medium text-slate-500 hover:text-indigo-600 transition-colors">
                                    <i class="bi bi-reply-fill text-sm"></i>
                                    <span>Balas</span>
                                </button>

                                <button wire:click="openReport({{ $comment->id }})" 
                                        class="flex items-center gap-1.5 text-xs font-medium text-slate-500 hover:text-amber-600 transition-colors ml-auto">
                                    <i class="bi bi-flag text-sm"></i>
                                    <span class="hidden sm:inline">Laporkan</span>
                                </button>

                                @if(auth()->user()->role === 'admin' || $comment->user_id === auth()->id())
                                    <button wire:click="deleteComment({{ $comment->id }})" 
                                            onclick="return confirm('Hapus komentar ini?')"
                                            class="flex items-center gap-1.5 text-xs font-medium text-slate-500 hover:text-red-600 transition-colors">
                                        <i class="bi bi-trash text-sm"></i>
                                        <span class="hidden sm:inline">Hapus</span>
                                    </button>
                                @endif
                            </div>

                            {{-- Report Form --}}
                            @if($showReportForm === $comment->id)
                                <div class="mt-4 p-4 bg-slate-50 rounded-xl border border-slate-200 animate-fade-in-down">
                                    <h6 class="text-sm font-bold text-slate-800 mb-3">Laporkan Komentar</h6>
                                    <form wire:submit.prevent="submitReport({{ $comment->id }})">
                                        <div class="space-y-3">
                                            <select wire:model="reportKategori.{{ $comment->id }}" 
                                                    class="w-full text-sm rounded-lg border-slate-300 focus:ring-indigo-500 focus:border-indigo-500">
                                                <option value="">Pilih alasan...</option>
                                                <option>Pelanggaran Aturan</option>
                                                <option>Konten Tidak Pantas</option>
                                                <option>Spam</option>
                                                <option>Lainnya</option>
                                            </select>
                                            
                                            <textarea wire:model="reportDeskripsi.{{ $comment->id }}"
                                                      class="w-full text-sm rounded-lg border-slate-300 focus:ring-indigo-500 focus:border-indigo-500" 
                                                      rows="2" 
                                                      placeholder="Detail laporan..."></textarea>
                                            
                                            <div class="flex gap-2 justify-end">
                                                <button type="button" wire:click="closeReport" class="px-3 py-1.5 text-xs font-medium text-slate-600 hover:bg-slate-200 rounded-lg transition-colors">Batal</button>
                                                <button type="submit" class="px-3 py-1.5 text-xs font-medium text-white bg-red-600 hover:bg-red-700 rounded-lg transition-colors">Kirim Laporan</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            @endif

                            {{-- Replies --}}
                            @if($comment->replies->isNotEmpty())
                                <div class="mt-4 pl-4 border-l-2 border-slate-100 space-y-4">
                                    @foreach($comment->replies as $reply)
                                        <div class="bg-slate-50 rounded-xl p-4">
                                            <div class="flex gap-3">
                                                {{-- Reply Avatar --}}
                                                <div class="flex-shrink-0">
                                                    @if($reply->user->profile_photo)
                                                        <img src="{{ asset('storage/'.$reply->user->profile_photo) }}" alt="{{ $reply->user->name }}" class="w-8 h-8 rounded-full object-cover ring-2 ring-white">
                                                    @else
                                                        <div class="w-8 h-8 rounded-full bg-gradient-to-br from-indigo-400 to-purple-500 flex items-center justify-center text-white font-bold text-xs ring-2 ring-white">
                                                            {{ substr($reply->user->name, 0, 1) }}
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="flex-1 min-w-0">
                                                    <div class="flex items-center justify-between mb-1">
                                                        <h5 class="text-xs font-bold text-slate-900">{{ $reply->user->name }}</h5>
                                                        <span class="text-[10px] text-slate-500">{{ $reply->created_at->diffForHumans() }}</span>
                                                    </div>
                                                    
                                                    <p class="text-sm text-slate-600 mb-2">{{ $reply->comment }}</p>

                                                    <div class="flex items-center gap-3">
                                                        <button wire:click="toggleLike({{ $reply->id }})" 
                                                                class="flex items-center gap-1 text-[10px] font-medium transition-colors {{ $reply->likes->isNotEmpty() ? 'text-indigo-600' : 'text-slate-500 hover:text-indigo-600' }}">
                                                            <i class="bi {{ $reply->likes->isNotEmpty() ? 'bi-hand-thumbs-up-fill' : 'bi-hand-thumbs-up' }}"></i>
                                                            <span>{{ $reply->likes()->count() }}</span>
                                                        </button>

                                                        <button wire:click="openReport({{ $reply->id }})" 
                                                                class="text-[10px] font-medium text-slate-500 hover:text-amber-600 transition-colors ml-auto">
                                                            Laporkan
                                                        </button>

                                                        @if(auth()->user()->role === 'admin' || $reply->user_id === auth()->id())
                                                            <button wire:click="deleteComment({{ $reply->id }})" 
                                                                    onclick="return confirm('Hapus balasan ini?')"
                                                                    class="text-[10px] font-medium text-slate-500 hover:text-red-600 transition-colors">
                                                                Hapus
                                                            </button>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach

            <div class="mt-6">
                {{ $comments->links() }}
            </div>
        @endif
    </div>
</div>