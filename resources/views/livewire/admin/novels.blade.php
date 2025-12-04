<div class="p-6 lg:p-8">
    
    {{-- Page Title --}}
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Kelola Novel</h1>
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
                                <span class="ml-1 text-sm font-medium text-slate-400 md:ml-2">Kelola Novel</span>
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

                {{-- Alert --}}
                @if (session()->has('message'))
                    <div class="mb-6 flex items-center p-4 bg-green-50 border border-green-200 rounded-xl text-green-800" role="alert">
                        <i class="bi bi-check-circle-fill text-green-500 text-xl mr-3"></i>
                        <span>{{ session('message') }}</span>
                        <button type="button" class="ml-auto text-green-500 hover:text-green-700" onclick="this.parentElement.remove()">
                            <i class="bi bi-x-lg"></i>
                        </button>
                    </div>
                @endif
              
                {{-- Form Tambah / Edit --}}
                @if (!$isEdit)
                    @include('livewire.admin.novels-form')
                @else
                    @include('livewire.admin.novels-edit')
                @endif

                <hr class="my-6 border-slate-200">

                {{-- Search --}}
                <div class="mb-6">
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                            <i class="bi bi-search text-slate-400"></i>
                        </div>
                        <input type="text" 
                               class="block w-full pl-10 pr-3 py-2.5 border border-slate-200 rounded-lg text-slate-900 placeholder-slate-400 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"
                               placeholder="Cari novel..."
                               wire:model.live="search">
                    </div>
                </div>

                {{-- Table --}}
                <div class="overflow-x-auto rounded-xl border border-slate-200">
                    <table class="w-full text-sm text-left">
                        <thead class="text-xs text-slate-700 uppercase bg-slate-50 border-b border-slate-200">
                            <tr>
                                <th scope="col" class="px-6 py-3 font-semibold">#</th>
                                <th scope="col" class="px-6 py-3 font-semibold">Judul</th>
                                <th scope="col" class="px-6 py-3 font-semibold">Status</th>
                                <th scope="col" class="px-6 py-3 font-semibold">Penulis</th>
                                <th scope="col" class="px-6 py-3 font-semibold">Genre</th>
                                <th scope="col" class="px-6 py-3 font-semibold">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($novels as $index => $novel)
                                <tr class="bg-white border-b border-slate-100 hover:bg-slate-50 transition-colors">
                                    <td class="px-6 py-4 font-medium text-slate-900">
                                        {{ $novels->firstItem() + $index }}
                                    </td>

                                    <td class="px-6 py-4 font-medium text-slate-900">
                                        {{ $novel->title }}
                                    </td>

                                    <td class="px-6 py-4">
                                        @if($novel->status === 'active')
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

                                    <td class="px-6 py-4 text-slate-600">
                                        {{ $novel->author ?? 'Tidak diketahui' }}
                                    </td>

                                    <td class="px-6 py-4">
                                        @if($novel->relationLoaded('genres') && $novel->genres->isNotEmpty())
                                            <div class="flex flex-wrap gap-1">
                                                @foreach($novel->genres as $genre)
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded-md text-xs font-medium bg-indigo-100 text-indigo-800">
                                                        {{ $genre->nama }}
                                                    </span>
                                                @endforeach
                                            </div>
                                        @else
                                            <span class="text-slate-400">-</span>
                                        @endif
                                    </td>

                                    <td class="px-6 py-4">
                                        <div class="flex gap-2">
                                            <button type="button"
                                                    class="inline-flex items-center px-3 py-1.5 bg-indigo-50 text-indigo-600 rounded-lg hover:bg-indigo-100 transition-colors"
                                                    wire:click="edit({{ $novel->id }})">
                                                <i class="bi bi-pencil text-sm"></i>
                                            </button>

                                            <button type="button"
                                                    class="inline-flex items-center px-3 py-1.5 bg-red-50 text-red-600 rounded-lg hover:bg-red-100 transition-colors"
                                                    wire:click="delete({{ $novel->id }})"
                                                    wire:confirm="Yakin hapus novel ini?">
                                                <i class="bi bi-trash text-sm"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>

                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-12 text-center">
                                        <div class="flex flex-col items-center">
                                            <i class="bi bi-inbox text-4xl text-slate-300 mb-2"></i>
                                            <span class="text-slate-500">Tidak ada novel</span>
                                        </div>
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>

                {{-- Pagination --}}
                <div class="mt-6">
                    {{ $novels->links() }}
                </div>

            </div>
        </div>
    </section>

</div>
