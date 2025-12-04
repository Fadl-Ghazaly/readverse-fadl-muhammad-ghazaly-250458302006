{{-- Form Edit Novel dengan Modern Design --}}
<div class="bg-gradient-to-br from-white to-slate-50 rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
    <div class="p-6 bg-gradient-to-r from-indigo-600 to-purple-600">
        <div class="flex items-center gap-3">
            <div class="p-2 bg-white/20 backdrop-blur-sm rounded-lg">
                <i class="bi bi-pencil-square text-white text-xl"></i>
            </div>
            <div>
                <h5 class="text-lg font-bold text-white">Edit Novel</h5>
                <p class="text-sm text-indigo-100 mt-0.5">Perbarui informasi novel Anda</p>
            </div>
        </div>
    </div>

    <form wire:submit.prevent="update" enctype="multipart/form-data" class="p-6 space-y-6">

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
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Current Cover --}}
                @if($old_cover)
                    <div>
                        <p class="text-xs font-medium text-slate-600 mb-2">Cover Saat Ini:</p>
                        <div class="relative group">
                            <img src="{{ asset('storage/' . $old_cover) }}" 
                                 alt="Current Cover" 
                                 class="w-full h-64 object-cover rounded-lg border-2 border-slate-200 shadow-md">
                            <div class="absolute inset-0 bg-black/50 opacity-0 group-hover:opacity-100 transition-opacity rounded-lg flex items-center justify-center">
                                <p class="text-white text-sm font-medium">Cover Lama</p>
                            </div>
                        </div>
                    </div>
                @endif

                {{-- New Cover Upload --}}
                <div>
                    <p class="text-xs font-medium text-slate-600 mb-2">Upload Cover Baru:</p>
                    <label for="cover_upload_edit" class="block cursor-pointer">
                        @if($cover_image)
                            <div class="relative">
                                <img src="{{ $cover_image->temporaryUrl() }}" 
                                     alt="New Preview" 
                                     class="w-full h-64 object-cover rounded-lg border-2 border-indigo-500 shadow-lg">
                                <div class="absolute top-2 right-2">
                                    <button type="button" 
                                            wire:click="$set('cover_image', null)"
                                            class="p-2 bg-red-500 text-white rounded-full hover:bg-red-600 shadow-lg transition-all">
                                        <i class="bi bi-x text-lg"></i>
                                    </button>
                                </div>
                                <div class="absolute bottom-2 left-2 px-3 py-1 bg-green-500 text-white text-xs font-medium rounded-full shadow-lg">
                                    <i class="bi bi-check-circle mr-1"></i>Cover Baru
                                </div>
                            </div>
                        @else
                            <div class="border-2 border-dashed border-slate-300 rounded-lg h-64 flex flex-col items-center justify-center hover:border-indigo-400 hover:bg-indigo-50/50 transition-all">
                                <i class="bi bi-cloud-upload text-4xl text-slate-400 mb-3"></i>
                                <p class="text-sm font-medium text-slate-700">Klik untuk upload</p>
                                <p class="text-xs text-slate-500 mt-1">PNG, JPG maksimal 2MB</p>
                            </div>
                        @endif
                        <input type="file" 
                               id="cover_upload_edit"
                               wire:model="cover_image"
                               accept="image/*"
                               class="hidden">
                    </label>
                </div>
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

        {{-- Action Buttons --}}
        <div class="flex items-center gap-3 pt-4 border-t border-slate-200">
            <button type="submit" 
                    class="px-6 py-2.5 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 shadow-lg shadow-green-500/30 hover:shadow-green-500/50 transition-all duration-300 transform hover:-translate-y-0.5 flex items-center gap-2">
                <i class="bi bi-check-circle"></i>
                <span>Update Novel</span>
            </button>
            <button type="button" 
                    wire:click="$set('isEdit', false)"
                    class="px-6 py-2.5 bg-slate-200 text-slate-700 font-medium rounded-lg hover:bg-slate-300 transition-all duration-200 flex items-center gap-2">
                <i class="bi bi-x-circle"></i>
                <span>Batal</span>
            </button>
            <p class="text-sm text-slate-500 ml-auto">
                <span class="text-red-500">*</span> Wajib diisi
            </p>
        </div>

    </form>
</div>