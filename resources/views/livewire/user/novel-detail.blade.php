<div class="min-h-screen bg-slate-50 pb-12">
    
    {{-- Breadcrumb & Back --}}
    <div class="bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
            <div class="flex items-center justify-between">
                <a href="{{ route('user.novels') }}" class="inline-flex items-center text-sm font-medium text-slate-600 hover:text-indigo-600 transition-colors">
                    <i class="bi bi-arrow-left mr-2"></i>
                    Kembali ke Daftar
                </a>
                <nav class="hidden sm:flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('user.homepage') }}" class="text-slate-500 hover:text-indigo-600 text-sm font-medium">Home</a>
                        </li>
                        <li><i class="bi bi-chevron-right text-slate-400 text-xs mx-1"></i></li>
                        <li class="inline-flex items-center">
                            <a href="{{ route('user.novels') }}" class="text-slate-500 hover:text-indigo-600 text-sm font-medium">Novel</a>
                        </li>
                        <li><i class="bi bi-chevron-right text-slate-400 text-xs mx-1"></i></li>
                        <li class="text-slate-400 text-sm font-medium truncate max-w-[150px]">{{ $novel->title }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        {{-- Main Info Card --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden mb-8">
            <div class="md:flex">
                {{-- Cover Image Section --}}
                <div class="md:w-1/3 lg:w-1/4 bg-slate-100 relative group">
                    @if($novel->cover_image)
                        <img src="{{ asset('storage/' . $novel->cover_image) }}" 
                             alt="{{ $novel->title }}" 
                             class="w-full h-full object-cover min-h-[400px]">
                    @else
                        <div class="w-full h-full min-h-[400px] flex items-center justify-center bg-slate-100 text-slate-300">
                            <i class="bi bi-image text-6xl"></i>
                        </div>
                    @endif
                    
                    {{-- Status Badge --}}
                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1 rounded-full text-xs font-bold uppercase tracking-wider bg-white/90 backdrop-blur-sm text-indigo-600 shadow-sm">
                            {{ $novel->status == 'active' ? 'Ongoing' : 'Completed' }}
                        </span>
                    </div>
                </div>

                {{-- Details Section --}}
                <div class="p-6 md:p-8 md:w-2/3 lg:w-3/4 flex flex-col">
                    <div class="flex-1">
                        <h1 class="text-3xl md:text-4xl font-bold text-slate-900 mb-2">{{ $novel->title }}</h1>
                        
                        <div class="flex items-center gap-4 text-sm text-slate-500 mb-6">
                            <span class="flex items-center gap-1">
                                <i class="bi bi-person-circle text-indigo-500"></i>
                                {{ $novel->author }}
                            </span>
                            <span class="flex items-center gap-1">
                                <i class="bi bi-star-fill text-amber-400"></i>
                                {{ $totalRatings > 0 ? number_format($averageRating, 1) : '0.0' }} ({{ $totalRatings }} ulasan)
                            </span>
                            <span class="flex items-center gap-1">
                                <i class="bi bi-heart-fill text-red-500"></i>
                                {{ $likeCount }} Suka
                            </span>
                        </div>

                        {{-- Genres --}}
                        <div class="flex flex-wrap gap-2 mb-6">
                            @forelse($novel->genres as $genre)
                                <span class="px-3 py-1 rounded-lg text-xs font-medium bg-indigo-50 text-indigo-700 border border-indigo-100">
                                    {{ $genre->nama }}
                                </span>
                            @empty
                                <span class="text-slate-400 text-sm italic">Tidak ada genre</span>
                            @endforelse
                        </div>

                        <div class="prose prose-slate max-w-none mb-8 text-slate-600">
                            <p>{{ $novel->description }}</p>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="flex flex-wrap items-center gap-3 pt-6 border-t border-slate-100">
                        {{-- Bookmark --}}
                        <button wire:click="toggleBookmark" 
                                class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200
                                       {{ $isBookmarked 
                                          ? 'bg-indigo-600 text-white shadow-lg shadow-indigo-500/30 hover:bg-indigo-700' 
                                          : 'bg-white text-slate-700 border border-slate-200 hover:bg-slate-50 hover:text-indigo-600' }}">
                            <i class="bi {{ $isBookmarked ? 'bi-bookmark-fill' : 'bi-bookmark' }} mr-2 text-lg"></i>
                            {{ $isBookmarked ? 'Tersimpan' : 'Simpan' }}
                        </button>

                        {{-- Like --}}
                        <button wire:click="toggleLike" 
                                class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-medium transition-all duration-200 border
                                       {{ $isLiked 
                                          ? 'bg-red-50 text-red-600 border-red-200 hover:bg-red-100' 
                                          : 'bg-white text-slate-700 border-slate-200 hover:bg-red-50 hover:text-red-600 hover:border-red-200' }}">
                            <i class="bi {{ $isLiked ? 'bi-heart-fill' : 'bi-heart' }} mr-2 text-lg {{ $isLiked ? 'text-red-500' : '' }}"></i>
                            Suka
                        </button>

                        {{-- Rating --}}
                        <div class="relative" x-data="{ open: false }">
                            <button @click="open = !open" @click.outside="open = false"
                                    class="inline-flex items-center px-4 py-2 rounded-xl text-sm font-medium bg-white text-slate-700 border border-slate-200 hover:bg-amber-50 hover:text-amber-600 hover:border-amber-200 transition-all duration-200">
                                <i class="bi bi-star mr-2 text-lg text-amber-400"></i>
                                {{ $userRating > 0 ? 'Rating: ' . $userRating : 'Beri Rating' }}
                            </button>

                            {{-- Rating Dropdown --}}
                            <div x-show="open" 
                                 x-transition:enter="transition ease-out duration-100"
                                 x-transition:enter-start="opacity-0 scale-95"
                                 x-transition:enter-end="opacity-100 scale-100"
                                 class="absolute bottom-full left-0 mb-2 p-2 bg-white rounded-xl shadow-xl border border-slate-200 flex gap-1 z-10">
                                @for($i = 1; $i <= 5; $i++)
                                    <button wire:click="submitRating({{ $i }}); open = false" 
                                            class="p-1 hover:scale-110 transition-transform text-amber-400">
                                        <i class="bi {{ $userRating >= $i ? 'bi-star-fill' : 'bi-star' }} text-xl"></i>
                                    </button>
                                @endfor
                            </div>
                        </div>

                        {{-- Report --}}
                        <a href="#reportForm" 
                           class="ml-auto inline-flex items-center px-3 py-2 rounded-xl text-sm font-medium text-slate-400 hover:text-red-600 hover:bg-red-50 transition-all duration-200">
                            <i class="bi bi-flag mr-2"></i>
                            Laporkan
                        </a>
                    </div>
                </div>
            </div>
        </div>

        {{-- Alert Messages --}}
        @if (session()->has('bookmarkMessage'))
            <div class="mb-6 p-4 rounded-xl bg-indigo-50 text-indigo-700 border border-indigo-100 flex items-center gap-3 animate-fade-in-down">
                <i class="bi bi-info-circle-fill text-xl"></i>
                {{ session('bookmarkMessage') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            {{-- Left Column: Episodes --}}
            <div class="lg:col-span-2 space-y-8">
                
                {{-- Episodes List --}}
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between bg-slate-50/50">
                        <h3 class="font-bold text-slate-800 flex items-center gap-2">
                            <i class="bi bi-collection-play text-indigo-600"></i>
                            Daftar Episode
                        </h3>
                        <span class="text-xs font-medium px-2.5 py-1 rounded-full bg-slate-100 text-slate-600">
                            {{ $episodes->count() }} Episode
                        </span>
                    </div>
                    
                    <div class="divide-y divide-slate-100">
                        @forelse ($episodes as $episode)
                            <div class="group flex items-center justify-between p-4 hover:bg-slate-50 transition-colors">
                                <div class="flex items-center gap-4">
                                    <div class="w-10 h-10 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold text-sm">
                                        #{{ $episode->episode_number }}
                                    </div>
                                    <div>
                                        <h4 class="font-medium text-slate-800 group-hover:text-indigo-600 transition-colors">
                                            {{ $episode->judul }}
                                        </h4>
                                        <p class="text-xs text-slate-500">
                                            {{ $episode->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>
                                <a href="{{ route('user.episode', [$novel->slug, $episode->episode_number]) }}" 
                                   class="inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium text-indigo-600 bg-indigo-50 hover:bg-indigo-600 hover:text-white transition-all duration-200">
                                    Baca
                                    <i class="bi bi-chevron-right ml-1 text-xs"></i>
                                </a>
                            </div>
                        @empty
                            <div class="p-8 text-center text-slate-500">
                                <i class="bi bi-journal-x text-3xl mb-2 block text-slate-300"></i>
                                Belum ada episode yang dirilis.
                            </div>
                        @endforelse
                    </div>
                </div>

                {{-- Comments Section --}}
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50">
                        <h3 class="font-bold text-slate-800 flex items-center gap-2">
                            <i class="bi bi-chat-dots text-indigo-600"></i>
                            Komentar & Diskusi
                        </h3>
                    </div>
                    <div class="p-6">
                        @livewire('user.novel-comments', ['novel' => $novel])
                    </div>
                </div>

            </div>

            {{-- Right Column: Report & Info --}}
            <div class="space-y-8">
                
                {{-- Report Form --}}
                <div id="reportForm" class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden scroll-mt-24">
                    <div class="px-6 py-4 border-b border-slate-100 bg-red-50/50">
                        <h3 class="font-bold text-slate-800 flex items-center gap-2">
                            <i class="bi bi-exclamation-triangle text-red-500"></i>
                            Laporkan Masalah
                        </h3>
                    </div>
                    <div class="p-6">
                        <p class="text-sm text-slate-500 mb-4">
                            Menemukan konten yang tidak pantas atau pelanggaran hak cipta? Beritahu kami.
                        </p>
                        @livewire('user.report-form', [
                            'targetType' => 'novel',
                            'targetId' => $novel->id
                        ])
                    </div>
                </div>

            </div>

        </div>
    </div>
</div>