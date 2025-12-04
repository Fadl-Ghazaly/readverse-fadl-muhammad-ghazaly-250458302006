<div class="min-h-screen bg-slate-50 pb-12">
    
    {{-- Header Section --}}
    <div class="bg-white border-b border-slate-200 mb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800 flex items-center gap-2">
                        <i class="bi bi-bookmarks-fill text-indigo-600"></i>
                        Bookmark Saya
                    </h1>
                    <p class="text-slate-500 mt-1">Koleksi novel favorit yang Anda simpan</p>
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
                                <span class="ml-1 text-sm font-medium text-slate-400 md:ml-2">Bookmark</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Add Bookmark Form --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-6 mb-8">
            <h3 class="text-lg font-bold text-slate-800 mb-4 flex items-center gap-2">
                <i class="bi bi-plus-circle-fill text-indigo-600"></i>
                Tambah Bookmark Baru
            </h3>
            
            <form wire:submit.prevent="addBookmark" class="flex flex-col md:flex-row gap-4 items-end">
                <div class="flex-1 w-full">
                    <label for="novel" class="block text-sm font-medium text-slate-700 mb-1">Pilih Novel</label>
                    <select wire:model="selectedNovel" id="novel" 
                            class="w-full rounded-xl border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-colors">
                        <option value="">-- Pilih Novel untuk Disimpan --</option>
                        @foreach($novels as $novel)
                            <option value="{{ $novel->id }}">{{ $novel->title }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" 
                        class="w-full md:w-auto px-6 py-2.5 bg-indigo-600 text-white font-medium rounded-xl hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-500/30 transition-all shadow-lg shadow-indigo-500/30 flex items-center justify-center gap-2">
                    <i class="bi bi-bookmark-plus"></i>
                    <span>Simpan Novel</span>
                </button>
            </form>
        </div>

        {{-- Bookmarks Grid --}}
        @if($bookmarks->count())
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 lg:gap-8">
                @foreach($bookmarks as $bookmark)
                    @php $novel = $bookmark->novel; @endphp
                    @if($novel)
                        <div class="group bg-white rounded-2xl shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border border-slate-100 overflow-hidden flex flex-col h-full relative">
                            
                            {{-- Remove Button (Absolute) --}}
                            <button wire:click="removeBookmark({{ $bookmark->id }})" 
                                    class="absolute top-3 right-3 z-10 p-2 bg-white/90 backdrop-blur-sm rounded-full text-slate-400 hover:text-red-600 hover:bg-red-50 shadow-sm transition-all opacity-0 group-hover:opacity-100"
                                    title="Hapus dari Bookmark">
                                <i class="bi bi-trash-fill"></i>
                            </button>

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
                                    <span>Lanjut Baca</span>
                                    <i class="bi bi-arrow-right transition-transform group-hover:translate-x-1"></i>
                                </a>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>

            <div class="mt-12">
                {{ $bookmarks->links() }}
            </div>

        @else
            <div class="text-center py-16 bg-white rounded-2xl border border-slate-100 shadow-sm">
                <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i class="bi bi-bookmarks text-4xl text-slate-300"></i>
                </div>
                <h3 class="text-lg font-semibold text-slate-700">Belum ada bookmark</h3>
                <p class="text-slate-500 mt-1">Mulai simpan novel favorit Anda untuk dibaca nanti!</p>
                <a href="{{ route('user.novels') }}" class="inline-flex items-center mt-4 px-6 py-2.5 bg-indigo-600 text-white font-medium rounded-xl hover:bg-indigo-700 transition-all">
                    Jelajahi Novel
                </a>
            </div>
        @endif

    </div>
</div>
