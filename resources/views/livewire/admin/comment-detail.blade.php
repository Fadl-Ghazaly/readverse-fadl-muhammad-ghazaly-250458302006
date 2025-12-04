<div class="p-6 lg:p-8">
    
    {{-- Page Title --}}
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Komentar: {{ $novel->title }}</h1>
                <nav class="flex mt-2" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('dashboard') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-indigo-600">
                                Home
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <i class="bi bi-chevron-right text-slate-400 text-xs mx-1"></i>
                                <a href="{{ route('admin.comments') }}" class="text-sm font-medium text-slate-500 hover:text-indigo-600">Komentar</a>
                            </div>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <i class="bi bi-chevron-right text-slate-400 text-xs mx-1"></i>
                                <span class="ml-1 text-sm font-medium text-slate-400 md:ml-2">Detail</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
            
            {{-- Back Button --}}
            <a href="{{ route('admin.comments') }}" class="inline-flex items-center px-4 py-2 bg-white border border-slate-200 rounded-lg text-slate-600 hover:bg-slate-50 hover:border-indigo-300 hover:text-indigo-600 transition-all duration-200 shadow-sm">
                <i class="bi bi-chevron-left mr-2"></i>
                Kembali
            </a>
        </div>
    </div>

    <section class="space-y-6">

        {{-- Alert sukses --}}
        @if (session()->has('message'))
            <div class="flex items-center p-4 bg-green-50 border border-green-200 rounded-xl text-green-800" role="alert">
                <i class="bi bi-check-circle-fill text-green-500 text-xl mr-3"></i>
                <span>{{ session('message') }}</span>
                <button type="button" class="ml-auto text-green-500 hover:text-green-700" onclick="this.parentElement.remove()">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
        @endif

        {{-- Mode reply alert --}}
        @if ($replyTo)
            <div class="flex items-center p-4 bg-blue-50 border border-blue-200 rounded-xl text-blue-800" role="alert">
                <i class="bi bi-reply-fill text-blue-500 text-xl mr-3"></i>
                <div class="flex-1">
                    <span>Membalas komentar dari <strong>{{ $replyTo->user->name }}</strong></span>
                </div>
                <button wire:click="cancelReply" class="px-4 py-2 bg-red-500 text-white text-sm font-medium rounded-lg hover:bg-red-600 transition-all">
                    <i class="bi bi-x-circle mr-1"></i>
                    Batal
                </button>
            </div>
        @endif

        {{-- Form komentar admin --}}
        <div class="bg-gradient-to-br from-white to-blue-50 rounded-2xl shadow-sm border border-blue-100 overflow-hidden">
            <div class="p-6 bg-white border-b border-blue-100">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-blue-50 rounded-lg">
                        <i class="bi bi-chat-left-dots-fill text-blue-600 text-xl"></i>
                    </div>
                    <div>
                        <h5 class="text-lg font-bold text-slate-800">Tambah Komentar Admin</h5>
                        <p class="text-sm text-slate-500 mt-0.5">Berikan komentar atau feedback untuk pembaca</p>
                    </div>
                </div>
            </div>
            <div class="p-6">
                <textarea class="w-full px-4 py-3 border border-slate-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all placeholder-slate-400 resize-none"
                          rows="4"
                          placeholder="Tulis komentar sebagai admin..."
                          wire:model.defer="commentText"></textarea>

                <div class="mt-4 flex justify-end">
                    <button wire:click="addComment" 
                            class="px-6 py-2.5 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 shadow-lg shadow-blue-500/30 hover:shadow-blue-500/50 transition-all duration-300 flex items-center gap-2">
                        <i class="bi bi-send-fill"></i>
                        <span>Kirim Komentar</span>
                    </button>
                </div>
            </div>
        </div>

        {{-- Daftar komentar --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100">
            <div class="p-6">

                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-slate-50 rounded-lg">
                            <i class="bi bi-chat-dots-fill text-slate-600 text-xl"></i>
                        </div>
                        <div>
                            <h5 class="text-lg font-bold text-slate-800">Semua Komentar</h5>
                            <p class="text-sm text-slate-500 mt-0.5">{{ $comments->total() }} total komentar</p>
                        </div>
                    </div>
                </div>

                <div class="space-y-4">
                    @foreach ($comments as $c)
                        <div class="border border-slate-200 rounded-xl p-5 hover:border-blue-200 hover:bg-blue-50/30 transition-all">
                            
                            {{-- Comment Header --}}
                            <div class="flex items-start justify-between mb-3">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                        {{ substr($c->user->name, 0, 1) }}
                                    </div>
                                    <div>
                                        <div class="font-semibold text-slate-800">{{ $c->user->name }}</div>
                                        <div class="text-xs text-slate-500">
                                            <i class="bi bi-clock mr-1"></i>{{ $c->created_at->diffForHumans() }}
                                        </div>
                                    </div>
                                </div>
                            </div>

                            {{-- Comment Content --}}
                            <p class="text-slate-700 mb-4 pl-13">{{ $c->comment }}</p>

                            {{-- Comment Actions --}}
                            <div class="flex gap-2 pl-13">
                                <button wire:click="setReply({{ $c->id }})"
                                        class="inline-flex items-center px-3 py-1.5 bg-blue-50 text-blue-600 rounded-lg hover:bg-blue-100 transition-colors text-sm">
                                    <i class="bi bi-reply mr-1.5"></i>
                                    Balas
                                </button>

                                <button wire:click="delete({{ $c->id }})"
                                        wire:confirm="Yakin hapus komentar ini?"
                                        class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors text-sm">
                                    <i class="bi bi-trash mr-1.5"></i>
                                    Hapus
                                </button>
                            </div>

                            {{-- Replies --}}
                            @if($c->replies->count())
                                <div class="mt-4 ml-13 space-y-3">
                                    @foreach ($c->replies as $reply)
                                        <div class="border-l-2 border-blue-300 pl-4 py-3 bg-slate-50/50 rounded-r-lg">
                                            <div class="flex items-start justify-between mb-2">
                                                <div class="flex items-center gap-2">
                                                    <div class="w-8 h-8 bg-gradient-to-br from-slate-500 to-slate-700 rounded-full flex items-center justify-center text-white font-bold text-xs">
                                                        {{ substr($reply->user->name, 0, 1) }}
                                                    </div>
                                                    <div>
                                                        <div class="font-semibold text-sm text-slate-800">{{ $reply->user->name }}</div>
                                                        <div class="text-xs text-slate-500">
                                                            <i class="bi bi-clock mr-1"></i>{{ $reply->created_at->diffForHumans() }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <p class="text-sm text-slate-700 mb-2">{{ $reply->comment }}</p>

                                            <button wire:click="delete({{ $reply->id }})"
                                                    wire:confirm="Yakin hapus balasan ini?"
                                                    class="inline-flex items-center px-2 py-1 bg-red-50 text-red-600 rounded-md hover:bg-red-100 transition-colors text-xs">
                                                <i class="bi bi-trash mr-1"></i>
                                                Hapus
                                            </button>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                        </div>
                    @endforeach
                </div>

                {{-- Pagination --}}
                <div class="mt-6">
                    {{ $comments->links() }}
                </div>

            </div>
        </div>

    </section>

</div>
