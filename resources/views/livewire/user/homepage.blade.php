<div class="min-h-screen bg-slate-50 pb-12">
    
   

    {{-- Content Section --}}
    <div id="browse-novels" class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-2xl font-bold text-slate-800 flex items-center gap-2">
                <i class="bi bi-book-half text-indigo-600"></i>
                Novel Terbaru
            </h2>
            
            {{-- Filter/Sort could go here --}}
        </div>

        @if($novels->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 lg:gap-8">
                @foreach($novels as $novel)
                    <div class="group bg-white rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-slate-100 overflow-hidden flex flex-col h-full">
                        
                        {{-- Cover Image --}}
                        <div class="relative aspect-[2/3] overflow-hidden bg-slate-100">
                            @if($novel->cover_image)
                                <img src="{{ asset('storage/'.$novel->cover_image) }}" 
                                     alt="{{ $novel->title }}"
                                     class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-slate-100 text-slate-300">
                                    <i class="bi bi-image text-4xl"></i>
                                </div>
                            @endif
                            
                            {{-- Overlay Gradient --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                            
                            {{-- Status Badge --}}
                            <div class="absolute top-3 right-3">
                                <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-white/90 backdrop-blur-sm text-indigo-600 shadow-sm">
                                    {{ $novel->status == 'active' ? 'Ongoing' : 'Completed' }}
                                </span>
                            </div>
                        </div>

                        {{-- Content --}}
                        <div class="p-5 flex-1 flex flex-col">
                            
                            {{-- Genres --}}
                            <div class="flex flex-wrap gap-1 mb-3">
                                @foreach($novel->genres->take(2) as $genre)
                                    <span class="text-[10px] uppercase tracking-wider font-semibold text-indigo-600 bg-indigo-50 px-2 py-1 rounded-md">
                                        {{ $genre->nama }}
                                    </span>
                                @endforeach
                                @if($novel->genres->count() > 2)
                                    <span class="text-[10px] text-slate-400 px-1 py-1">+{{ $novel->genres->count() - 2 }}</span>
                                @endif
                            </div>

                            <h3 class="text-lg font-bold text-slate-800 mb-1 line-clamp-1 group-hover:text-indigo-600 transition-colors">
                                <a href="{{ route('user.novel', $novel->slug) }}">
                                    {{ $novel->title }}
                                </a>
                            </h3>
                            
                            <p class="text-sm text-slate-500 mb-3 flex items-center gap-1">
                                <i class="bi bi-person-circle text-xs"></i>
                                {{ $novel->author }}
                            </p>

                            <p class="text-sm text-slate-600 line-clamp-2 mb-4 flex-1">
                                {{ Str::limit($novel->description, 100) }}
                            </p>

                            <a href="{{ route('user.novel', $novel->slug) }}" 
                               class="w-full mt-auto flex items-center justify-center gap-2 px-4 py-2.5 bg-slate-50 text-slate-700 font-medium rounded-xl hover:bg-indigo-600 hover:text-white transition-all duration-300 group-hover:shadow-lg group-hover:shadow-indigo-500/20">
                                <span>Baca Sekarang</span>
                                <i class="bi bi-arrow-right transition-transform group-hover:translate-x-1"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-12">
                {{ $novels->links() }}
            </div>

        @else
            <div class="text-center py-16 bg-white rounded-2xl border border-slate-100 shadow-sm">
                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="bi bi-journal-x text-4xl text-slate-300"></i>
                </div>
                <h3 class="text-lg font-semibold text-slate-700">Belum ada novel tersedia</h3>
                <p class="text-slate-500 mt-1">Nantikan update novel terbaru dari kami!</p>
            </div>
        @endif

    </div>
</div>
