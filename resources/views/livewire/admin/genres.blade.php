<div class="p-6 lg:p-8">
    
    {{-- Page Title --}}
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Kelola Genre</h1>
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
                                <span class="ml-1 text-sm font-medium text-slate-400 md:ml-2">Kelola Genre</span>
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
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100">
            <div class="p-6">

                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-orange-50 rounded-lg">
                            <i class="bi bi-tags-fill text-orange-600 text-xl"></i>
                        </div>
                        <div>
                            <h5 class="text-lg font-bold text-slate-800">Daftar Genre</h5>
                            <p class="text-sm text-slate-500 mt-0.5">Kelola kategori genre novel</p>
                        </div>
                    </div>
                </div>

                {{-- Alert Notification --}}
                @if (session()->has('message'))
                    <div class="mb-6 flex items-center p-4 bg-green-50 border border-green-200 rounded-xl text-green-800" role="alert">
                        <i class="bi bi-check-circle-fill text-green-500 text-xl mr-3"></i>
                        <span>{{ session('message') }}</span>
                        <button type="button" class="ml-auto text-green-500 hover:text-green-700" onclick="this.parentElement.remove()">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                @endif

                {{-- Form Genre --}}
                <form wire:submit.prevent="store" class="mb-6">
                    <div class="flex gap-3 items-start">
                        <div class="flex-1">
                            <input type="text" 
                                   wire:model="nama" 
                                   class="w-full px-4 py-2.5 border border-slate-200 rounded-lg focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all placeholder-slate-400"
                                   placeholder="Masukkan nama genre baru...">
                            @error('nama')
                                <p class="mt-1.5 text-sm text-red-600 flex items-center gap-1">
                                    <i class="bi bi-exclamation-circle"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="flex gap-2">
                            @if($genre_id)
                                <button type="submit" 
                                        class="px-6 py-2.5 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 shadow-lg shadow-green-500/30 hover:shadow-green-500/50 transition-all duration-300 flex items-center gap-2 whitespace-nowrap">
                                    <i class="bi bi-check-circle"></i>
                                    <span>Perbarui</span>
                                </button>
                                <button type="button" 
                                        wire:click="cancelEdit"
                                        class="px-6 py-2.5 bg-slate-200 text-slate-700 font-medium rounded-lg hover:bg-slate-300 transition-all duration-200 flex items-center gap-2">
                                    <i class="bi bi-x-circle"></i>
                                    <span>Batal</span>
                                </button>
                            @else
                                <button type="submit" 
                                        class="px-6 py-2.5 bg-orange-600 text-white font-medium rounded-lg hover:bg-orange-700 shadow-lg shadow-orange-500/30 hover:shadow-orange-500/50 transition-all duration-300 flex items-center gap-2 whitespace-nowrap">
                                    <i class="bi bi-plus-circle"></i>
                                    <span>Tambah</span>
                                </button>
                            @endif
                        </div>
                    </div>
                </form>

                {{-- Table Genre --}}
                <div class="overflow-x-auto rounded-xl border border-slate-200">
                    <table class="w-full text-sm text-left">
                        <thead class="text-xs text-slate-700 uppercase bg-slate-50 border-b border-slate-200">
                            <tr>
                                <th scope="col" class="px-6 py-3 font-semibold w-20">#</th>
                                <th scope="col" class="px-6 py-3 font-semibold">Nama Genre</th>
                                <th scope="col" class="px-6 py-3 font-semibold text-center w-32">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($genres as $index => $genre)
                                <tr class="bg-white border-b border-slate-100 hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-4 text-slate-500">
                                        {{ $index + 1 }}
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-orange-100 text-orange-800">
                                                <i class="bi bi-tag-fill mr-1.5 text-xs"></i>
                                                {{ $genre->nama }}
                                            </span>
                                        </div>
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="flex gap-2 justify-center">
                                            <button type="button"
                                                    wire:click="edit({{ $genre->id }})"
                                                    class="inline-flex items-center px-3 py-1.5 bg-indigo-50 text-indigo-600 rounded-lg hover:bg-indigo-100 transition-colors"
                                                    title="Edit">
                                                <i class="bi bi-pencil text-sm"></i>
                                            </button>

                                            <button type="button"
                                                    wire:click="delete({{ $genre->id }})"
                                                    wire:confirm="Yakin hapus genre ini?"
                                                    class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors"
                                                    title="Hapus">
                                                <i class="bi bi-trash text-sm"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <i class="bi bi-tags text-4xl text-slate-300 mb-2"></i>
                                            <span class="text-slate-500">Belum ada genre</span>
                                            <p class="text-sm text-slate-400 mt-1">Tambahkan genre pertama Anda</p>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>

                    </table>
                </div>

            </div>
        </div>
    </section>

</div>
