{{-- Form Tambah Novel dengan Modern Design --}}
<div class="bg-gradient-to-br from-white to-slate-50 rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
    <div class="p-6 bg-white border-b border-slate-100">
        <div class="flex items-center gap-3">
            <div class="p-2 bg-indigo-50 rounded-lg">
                <i class="bi bi-plus-circle text-indigo-600 text-xl"></i>
            </div>
            <div>
                <h5 class="text-lg font-bold text-slate-800">Tambah Novel Baru</h5>
                <p class="text-sm text-slate-500 mt-0.5">Isi form di bawah untuk menambahkan novel</p>
            </div>
        </div>
    </div>

    <form wire:submit.prevent="store" enctype="multipart/form-data" class="p-6 space-y-6">

        {{-- Judul --}}
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">
                <i class="bi bi-book mr-1.5 text-indigo-600"></i>Judul Novel
                <span class="text-red-500">*</span>
            </label>
            <input type="text" 
                   wire:model="title"
                   class="w-full px-4 py-2.5 border border-slate-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all placeholder-slate-400"
                   placeholder="Masukkan judul novel...">
            @error('title')
                <p class="mt-1.5 text-sm text-red-600 flex items-center gap-1">
                    <i class="bi bi-exclamation-circle"></i>{{ $message }}
                </p>
            @enderror
        </div>

        {{-- Penulis --}}
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">
                <i class="bi bi-person mr-1.5 text-indigo-600"></i>Penulis
            </label>
            <input type="text" 
                   wire:model="author"
                   class="w-full px-4 py-2.5 border border-slate-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all placeholder-slate-400"
                   placeholder="Nama penulis...">
            @error('author')
                <p class="mt-1.5 text-sm text-red-600 flex items-center gap-1">
                    <i class="bi bi-exclamation-circle"></i>{{ $message }}
                </p>
            @enderror
        </div>

        {{-- Deskripsi --}}
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">
                <i class="bi bi-text-paragraph mr-1.5 text-indigo-600"></i>Deskripsi
            </label>
            <textarea wire:model="description" 
                      rows="5"
                      class="w-full px-4 py-2.5 border border-slate-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all placeholder-slate-400 resize-none"
                      placeholder="Tuliskan sinopsis atau deskripsi novel..."></textarea>
            @error('description')
                <p class="mt-1.5 text-sm text-red-600 flex items-center gap-1">
                    <i class="bi bi-exclamation-circle"></i>{{ $message }}
                </p>
            @enderror
        </div>

        {{-- Genre --}}
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-3">
                <i class="bi bi-tags mr-1.5 text-indigo-600"></i>Genre
            </label>
            <div class="flex flex-wrap gap-2">
                @foreach($allGenres as $genre)
                    <label class="genre-pill inline-flex items-center px-4 py-2 rounded-full cursor-pointer transition-all duration-200 bg-slate-100 text-slate-700 hover:bg-slate-200
                                   has-[:checked]:bg-indigo-600 has-[:checked]:text-white has-[:checked]:shadow-md has-[:checked]:shadow-indigo-500/30">
                        <input type="checkbox"
                               wire:model.live="selectedGenres"
                               value="{{ $genre->id }}"
                               class="appearance-none w-0 h-0">
                        <span class="text-sm font-medium">{{ $genre->nama }}</span>
                        <i class="bi bi-check-circle-fill ml-1.5 text-xs hidden has-[:checked]:inline-block"></i>
                    </label>
                @endforeach
            </div>
            @error('selectedGenres')
                <p class="mt-1.5 text-sm text-red-600 flex items-center gap-1">
                    <i class="bi bi-exclamation-circle"></i>{{ $message }}
                </p>
            @enderror
        </div>

        {{-- Cover Image --}}
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">
                <i class="bi bi-image mr-1.5 text-indigo-600"></i>Cover Image
            </label>
            <div class="flex items-start gap-4">
                <label for="cover_upload_new" class="flex-1 cursor-pointer">
                    <div class="border-2 border-dashed border-slate-300 rounded-lg p-6 text-center hover:border-indigo-400 hover:bg-indigo-50/50 transition-all">
                        <i class="bi bi-cloud-upload text-3xl text-slate-400 mb-2"></i>
                        <p class="text-sm font-medium text-slate-700">Klik untuk upload cover</p>
                        <p class="text-xs text-slate-500 mt-1">PNG, JPG maksimal 2MB</p>
                    </div>
                    <input type="file" 
                           id="cover_upload_new"
                           wire:model="cover_image"
                           accept="image/*"
                           class="hidden">
                </label>
                
                @if($cover_image)
                    <div class="flex-shrink-0">
                        <div class="relative">
                            <img src="{{ $cover_image->temporaryUrl() }}" 
                                 alt="Preview" 
                                 class="w-32 h-44 object-cover rounded-lg border-2 border-indigo-200 shadow-lg">
                            <div class="absolute top-2 right-2">
                                <button type="button" 
                                        wire:click="$set('cover_image', null)"
                                        class="p-1.5 bg-red-500 text-white rounded-full hover:bg-red-600 shadow-lg transition-all">
                                    <i class="bi bi-x text-sm"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            @error('cover_image')
                <p class="mt-1.5 text-sm text-red-600 flex items-center gap-1">
                    <i class="bi bi-exclamation-circle"></i>{{ $message }}
                </p>
            @enderror
        </div>

        {{-- Status --}}
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-2">
                <i class="bi bi-toggle-on mr-1.5 text-indigo-600"></i>Status
            </label>
            <div class="flex gap-4">
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" 
                           wire:model="status" 
                           value="active"
                           class="w-4 h-4 text-indigo-600 focus:ring-2 focus:ring-indigo-500">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                        <span class="w-1.5 h-1.5 mr-1.5 bg-green-500 rounded-full"></span>
                        Aktif
                    </span>
                </label>
                <label class="flex items-center gap-2 cursor-pointer">
                    <input type="radio" 
                           wire:model="status" 
                           value="inactive"
                           class="w-4 h-4 text-indigo-600 focus:ring-2 focus:ring-indigo-500">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-red-100 text-red-800">
                        <span class="w-1.5 h-1.5 mr-1.5 bg-red-500 rounded-full"></span>
                        Nonaktif
                    </span>
                </label>
            </div>
            @error('status')
                <p class="mt-1.5 text-sm text-red-600 flex items-center gap-1">
                    <i class="bi bi-exclamation-circle"></i>{{ $message }}
                </p>
            @enderror
        </div>

        {{-- Submit Button --}}
        <div class="flex items-center gap-3 pt-4 border-t border-slate-200">
            <button type="submit" 
                    class="px-6 py-2.5 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 shadow-lg shadow-indigo-500/30 hover:shadow-indigo-500/50 transition-all duration-300 transform hover:-translate-y-0.5 flex items-center gap-2">
                <i class="bi bi-save"></i>
                <span>Simpan Novel</span>
            </button>
            <p class="text-sm text-slate-500">
                <span class="text-red-500">*</span> Wajib diisi
            </p>
        </div>

    </form>
</div>