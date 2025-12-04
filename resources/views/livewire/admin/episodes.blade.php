<div class="p-6 lg:p-8">
    
    {{-- Page Title --}}
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Kelola Episode</h1>
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
                                <span class="ml-1 text-sm font-medium text-slate-400 md:ml-2">Kelola Episode</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
            
            {{-- Back Button --}}
            <a href="{{ route('dashboard') }}" class="inline-flex items-center px-4 py-2 bg-white border border-slate-200 rounded-lg text-slate-600 hover:bg-slate-50 hover:border-indigo-300 hover:text-indigo-600 transition-all duration-200 shadow-sm">
                <i class="bi bi-chevron-left mr-2"></i>
                Kembali
            </a>
        </div>
    </div>

    <section>
        {{-- Alert Message --}}
        @if (session()->has('message'))
            <div class="mb-6 flex items-center p-4 bg-green-50 border border-green-200 rounded-xl text-green-800" role="alert">
                <i class="bi bi-check-circle-fill text-green-500 text-xl mr-3"></i>
                <span>{{ session('message') }}</span>
                <button type="button" class="ml-auto text-green-500 hover:text-green-700" onclick="this.parentElement.remove()">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
        @endif

        {{-- Form Episode --}}
        <div class="bg-gradient-to-br from-white to-slate-50 rounded-2xl shadow-sm border border-slate-200 overflow-hidden mb-6">
            <div class="p-6 bg-white border-b border-slate-100">
                <div class="flex items-center gap-3">
                    <div class="p-2 bg-indigo-50 rounded-lg">
                        <i class="bi bi-plus-circle text-indigo-600 text-xl"></i>
                    </div>
                    <div>
                        <h5 class="text-lg font-bold text-slate-800">Tambah Episode Baru</h5>
                        <p class="text-sm text-slate-500 mt-0.5">Isi form untuk menambahkan episode novel</p>
                    </div>
                </div>
            </div>

            <form wire:submit.prevent="store" enctype="multipart/form-data" class="p-6">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                    {{-- Pilih Novel --}}
                    <div class="md:col-span-1">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            <i class="bi bi-book mr-1.5 text-indigo-600"></i>Pilih Novel
                            <span class="text-red-500">*</span>
                        </label>
                        <select wire:model="novel_id" class="w-full px-4 py-2.5 border border-slate-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all">
                            <option value="">-- Pilih Novel --</option>
                            @foreach($novels as $novel)
                                <option value="{{ $novel->id }}">{{ $novel->title }}</option>
                            @endforeach
                        </select>
                        @error('novel_id')
                            <p class="mt-1.5 text-sm text-red-600 flex items-center gap-1">
                                <i class="bi bi-exclamation-circle"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Judul Episode --}}
                    <div class="md:col-span-1">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            <i class="bi bi-journal-text mr-1.5 text-indigo-600"></i>Judul Episode
                            <span class="text-red-500">*</span>
                        </label>
                        <input type="text" 
                               wire:model="judul"
                               class="w-full px-4 py-2.5 border border-slate-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all placeholder-slate-400"
                               placeholder="Masukkan judul episode...">
                        @error('judul')
                            <p class="mt-1.5 text-sm text-red-600 flex items-center gap-1">
                                <i class="bi bi-exclamation-circle"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Nomor Episode --}}
                    <div class="md:col-span-1">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            <i class="bi bi-hash mr-1.5 text-indigo-600"></i>Nomor Episode
                        </label>
                        <input type="number" 
                               wire:model="episode_number"
                               class="w-full px-4 py-2.5 border border-slate-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all placeholder-slate-400"
                               placeholder="Contoh: 1">
                        @error('episode_number')
                            <p class="mt-1.5 text-sm text-red-600 flex items-center gap-1">
                                <i class="bi bi-exclamation-circle"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Deskripsi --}}
                    <div class="md:col-span-1">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            <i class="bi bi-text-paragraph mr-1.5 text-indigo-600"></i>Deskripsi
                        </label>
                        <textarea wire:model="deskripsi" 
                                  rows="3"
                                  class="w-full px-4 py-2.5 border border-slate-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all placeholder-slate-400 resize-none"
                                  placeholder="Deskripsi singkat episode..."></textarea>
                        @error('deskripsi')
                            <p class="mt-1.5 text-sm text-red-600 flex items-center gap-1">
                                <i class="bi bi-exclamation-circle"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Cover Image --}}
                    <div class="md:col-span-1">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            <i class="bi bi-image mr-1.5 text-indigo-600"></i>Cover Episode
                        </label>
                        <input type="file" 
                               wire:model="cover_image"
                               accept="image/*"
                               class="w-full px-4 py-2.5 border border-slate-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                        @error('cover_image')
                            <p class="mt-1.5 text-sm text-red-600 flex items-center gap-1">
                                <i class="bi bi-exclamation-circle"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- File Episode --}}
                    <div class="md:col-span-1">
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            <i class="bi bi-file-earmark-text mr-1.5 text-indigo-600"></i>File Episode
                        </label>
                        <input type="file" 
                               wire:model="file_path"
                               class="w-full px-4 py-2.5 border border-slate-200 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                        @error('file_path')
                            <p class="mt-1.5 text-sm text-red-600 flex items-center gap-1">
                                <i class="bi bi-exclamation-circle"></i>{{ $message }}
                            </p>
                        @enderror
                    </div>

                    {{-- Status --}}
                    <div class="md:col-span-2">
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
                    <div class="md:col-span-2 flex items-center gap-3 pt-4 border-t border-slate-200">
                        <button type="submit" 
                                class="px-6 py-2.5 bg-indigo-600 text-white font-medium rounded-lg hover:bg-indigo-700 shadow-lg shadow-indigo-500/30 hover:shadow-indigo-500/50 transition-all duration-300 transform hover:-translate-y-0.5 flex items-center gap-2">
                            <i class="bi bi-save"></i>
                            <span>Simpan Episode</span>
                        </button>
                        <p class="text-sm text-slate-500">
                            <span class="text-red-500">*</span> Wajib diisi
                        </p>
                    </div>

                </div>
            </form>
        </div>

        {{-- Daftar Episode --}}
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100">
            <div class="p-6">
                <h5 class="text-lg font-bold text-slate-800 mb-6">Daftar Episode</h5>

                {{-- Search --}}
                <div class="mb-6">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <i class="bi bi-search text-slate-400"></i>
                        </div>
                        <input type="text" 
                               class="block w-full pl-10 pr-3 py-2.5 border border-slate-200 rounded-lg text-slate-900 placeholder-slate-400 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"
                               placeholder="Cari episode..."
                               wire:model.live="search">
                    </div>
                </div>

                {{-- Table --}}
                <div class="overflow-x-auto rounded-xl border border-slate-200">
                    <table class="w-full text-sm text-left">
                        <thead class="text-xs text-slate-700 uppercase bg-slate-50 border-b border-slate-200">
                            <tr>
                                <th scope="col" class="px-6 py-3 font-semibold">Novel</th>
                                <th scope="col" class="px-6 py-3 font-semibold">Judul Episode</th>
                                <th scope="col" class="px-6 py-3 font-semibold">No</th>
                                <th scope="col" class="px-6 py-3 font-semibold">Status</th>
                                <th scope="col" class="px-6 py-3 font-semibold text-center">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($episodes as $ep)
                                <tr class="bg-white border-b border-slate-100 hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-4 text-slate-900">
                                        {{ $ep->novel->title }}
                                    </td>
                                    <td class="px-6 py-4 font-medium text-slate-900">
                                        {{ $ep->judul }}
                                    </td>
                                    <td class="px-6 py-4 text-slate-600">
                                        #{{ $ep->episode_number }}
                                    </td>
                                    <td class="px-6 py-4">
                                        @if($ep->status === 'active')
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                <span class="w-1.5 h-1.5 mr-1.5 bg-green-500 rounded-full"></span>
                                                Aktif
                                            </span>
                                        @else
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                <span class="w-1.5 h-1.5 mr-1.5 bg-red-500 rounded-full"></span>
                                                Nonaktif
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex gap-2 justify-center">
                                            <button type="button"
                                                    class="inline-flex items-center px-3 py-1.5 bg-indigo-50 text-indigo-600 rounded-lg hover:bg-indigo-100 transition-colors"
                                                    wire:click="edit({{ $ep->id }})">
                                                <i class="bi bi-pencil text-sm"></i>
                                            </button>

                                            <button type="button"
                                                    class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors"
                                                    wire:click="delete({{ $ep->id }})"
                                                    wire:confirm="Yakin hapus episode ini?">
                                                <i class="bi bi-trash text-sm"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <i class="bi bi-inbox text-4xl text-slate-300 mb-2"></i>
                                            <span class="text-slate-500">Tidak ada episode</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="mt-6">
                    {{ $episodes->links() }}
                </div>

            </div>
        </div>

    </section>

</div>
