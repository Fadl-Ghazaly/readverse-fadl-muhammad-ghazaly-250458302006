<div class="min-h-screen bg-slate-50 pb-12">
    
    {{-- Header Section --}}
    <div class="bg-white border-b border-slate-200 mb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800 flex items-center gap-2">
                        <i class="bi bi-search text-indigo-600"></i>
                        Hasil Pencarian
                    </h1>
                    <p class="text-slate-500 mt-1">Menampilkan hasil untuk "<strong>{{ $query }}</strong>"</p>
                </div>
                
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('user.homepage') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-indigo-600 transition-colors">
                                <i class="bi bi-house-door-fill mr-2"></i>
                                Home
                            </a>
                        </li>
                        <li>
                            <div class="flex items-center">
                                <i class="bi bi-chevron-right text-slate-400 text-xs mx-1"></i>
                                <span class="ml-1 text-sm font-medium text-slate-400 md:ml-2">Pencarian</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        @if($novels->isEmpty() && $episodes->isEmpty())
            <div class="text-center py-16 bg-white rounded-2xl border border-slate-200 shadow-sm">
                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="bi bi-search text-4xl text-slate-300"></i>
                </div>
                <h3 class="text-lg font-semibold text-slate-700">Tidak ada hasil ditemukan</h3>
                <p class="text-slate-500 mt-1">Coba gunakan kata kunci lain atau periksa ejaan Anda.</p>
                <a href="{{ route('user.novels') }}" class="inline-flex items-center mt-4 px-6 py-2.5 bg-indigo-600 text-white font-medium rounded-xl hover:bg-indigo-700 transition-all">
                    Jelajahi Novel
                </a>
            </div>
        @else
            
            {{-- Novel Results --}}
            @if($novels->isNotEmpty())
                <div class="mb-12">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-bold text-slate-800 flex items-center gap-2">
                            <i class="bi bi-book-fill text-indigo-600"></i>
                            Novel
                            <span class="text-sm font-normal text-slate-500 ml-2">({{ $novels->total() }} hasil)</span>
                        </h2>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        @foreach($novels as $novel)
                            <div class="group bg-white rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-slate-100 overflow-hidden flex flex-col h-full">
                                {{-- Cover Image --}}
                                <div class="relative aspect-[2/3] overflow-hidden bg-slate-100">
                                    @if($novel->cover_image)
                                        <img src="{{ asset('storage/' . $novel->cover_image) }}" 
                                             alt="{{ $novel->title }}"
                                             class="w-full h-full object-cover transform group-hover:scale-105 transition-transform duration-500">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center bg-slate-100 text-slate-300">
                                            <i class="bi bi-image text-4xl"></i>
                                        </div>
                                    @endif
                                    
                                    {{-- Overlay --}}
                                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                                </div>

                                {{-- Content --}}
                                <div class="p-5 flex-1 flex flex-col">
                                    <h3 class="text-lg font-bold text-slate-800 mb-1 line-clamp-1 group-hover:text-indigo-600 transition-colors">
                                        <a href="{{ route('user.novel', $novel->slug) }}">
                                            {{ $novel->title }}
                                        </a>
                                    </h3>
                                    
                                    <p class="text-sm text-slate-600 line-clamp-2 mb-4 flex-1">
                                        {{ Str::limit($novel->description, 100) }}
                                    </p>

                                    <a href="{{ route('user.novel', $novel->slug) }}" 
                                       class="w-full mt-auto flex items-center justify-center gap-2 px-4 py-2.5 bg-slate-50 text-slate-700 font-medium rounded-xl hover:bg-indigo-600 hover:text-white transition-all duration-300 group-hover:shadow-lg group-hover:shadow-indigo-500/20">
                                        <span>Lihat Detail</span>
                                        <i class="bi bi-arrow-right transition-transform group-hover:translate-x-1"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    
                    <div class="mt-6">
                        {{ $novels->links() }}
                    </div>
                </div>
            @endif

            {{-- Episode Results --}}
            @if($episodes->isNotEmpty())
                <div>
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-bold text-slate-800 flex items-center gap-2">
                            <i class="bi bi-collection-play-fill text-indigo-600"></i>
                            Episode
                            <span class="text-sm font-normal text-slate-500 ml-2">({{ $episodes->total() }} hasil)</span>
                        </h2>
                    </div>

                    <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                        <div class="divide-y divide-slate-100">
                            @foreach($episodes as $e)
                                <div class="group flex items-center justify-between p-4 hover:bg-slate-50 transition-colors">
                                    <div class="flex items-center gap-4">
                                        <div class="w-10 h-10 rounded-lg bg-indigo-50 text-indigo-600 flex items-center justify-center font-bold text-sm flex-shrink-0">
                                            #{{ $e->episode_number }}
                                        </div>
                                        <div class="min-w-0">
                                            <h4 class="font-medium text-slate-800 group-hover:text-indigo-600 transition-colors truncate">
                                                {{ $e->judul }}
                                            </h4>
                                            <p class="text-xs text-slate-500 truncate">
                                                Novel: <span class="font-medium text-slate-600">{{ $e->novel->title }}</span>
                                            </p>
                                        </div>
                                    </div>
                                    <a href="{{ route('user.episode', [$e->novel->slug, $e->episode_number]) }}" 
                                       class="flex-shrink-0 inline-flex items-center px-4 py-2 rounded-lg text-sm font-medium text-indigo-600 bg-indigo-50 hover:bg-indigo-600 hover:text-white transition-all duration-200">
                                        Baca
                                        <i class="bi bi-chevron-right ml-1 text-xs"></i>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-6">
                        {{ $episodes->links() }}
                    </div>
                </div>
            @endif

        @endif

    </div>
</div>