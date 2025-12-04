<div class="p-6 lg:p-8">
    
    {{-- Page Title --}}
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Detail Laporan</h1>
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
                                <a href="{{ route('admin.reports') }}" class="text-sm font-medium text-slate-500 hover:text-indigo-600">Laporan</a>
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
            <a href="{{ route('admin.reports') }}" class="inline-flex items-center px-4 py-2 bg-white border border-slate-200 rounded-lg text-slate-600 hover:bg-slate-50 hover:border-indigo-300 hover:text-indigo-600 transition-all duration-200 shadow-sm">
                <i class="bi bi-chevron-left mr-2"></i>
                Kembali
            </a>
        </div>
    </div>

    <section>
        
        {{-- Report Detail Card --}}
        <div class="bg-white rounded-2xl shadow-sm border-l-4 border-amber-500">
            <div class="p-6">

                {{-- Header --}}
                <div class="flex items-center gap-4 pb-6 border-b border-slate-200">
                    <div class="w-16 h-16 bg-amber-100 rounded-2xl flex items-center justify-center">
                        <i class="bi bi-exclamation-triangle-fill text-amber-600 text-3xl"></i>
                    </div>
                    <div class="flex-1">
                        <h2 class="text-2xl font-bold text-slate-800 mb-1">{{ $report->kategori }}</h2>
                        <div class="flex items-center gap-3">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                                <span class="w-1.5 h-1.5 mr-1.5 bg-amber-500 rounded-full"></span>
                                {{ $report->status }}
                            </span>
                            <span class="text-sm text-slate-500">
                                <i class="bi bi-clock mr-1"></i>{{ $report->created_at->format('d M Y, H:i') }}
                            </span>
                        </div>
                    </div>
                </div>

                {{-- Report Information --}}
                <div class="py-6 space-y-6">

                    {{-- Pelapor Info --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-600 mb-3">
                            <i class="bi bi-person-fill mr-1.5 text-amber-600"></i>Pelapor
                        </label>
                        <div class="flex items-center gap-3 p-4 bg-slate-50 rounded-xl">
                            <div class="w-12 h-12 bg-gradient-to-br from-amber-500 to-orange-600 rounded-full flex items-center justify-center text-white font-bold text-lg">
                                {{ substr($report->user->name, 0, 1) }}
                            </div>
                            <div>
                                <div class="font-semibold text-slate-800">{{ $report->user->name }}</div>
                                <div class="text-sm text-slate-500">{{ $report->user->email }}</div>
                            </div>
                        </div>
                    </div>

                    {{-- Target Info --}}
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-slate-600 mb-2">
                                <i class="bi bi-bullseye mr-1.5 text-amber-600"></i>Tipe Target
                            </label>
                            <div class="p-3 bg-slate-50 rounded-lg">
                                <span class="inline-flex items-center px-3 py-1 rounded-md text-sm font-medium bg-white border border-slate-200 text-slate-700">
                                    {{ $report->target_type_name }}
                                </span>
                            </div>
                        </div>
                        <div>
                            <label class="block text-sm font-semibold text-slate-600 mb-2">
                                <i class="bi bi-bookmark-fill mr-1.5 text-amber-600"></i>Target
                            </label>
                            <div class="p-3 bg-slate-50 rounded-lg">
                                <p class="font-medium text-slate-800">{{ $report->target_title }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Kategori Laporan --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-600 mb-2">
                            <i class="bi bi-tag-fill mr-1.5 text-amber-600"></i>Kategori Laporan
                        </label>
                        <div class="p-3 bg-slate-50 rounded-lg">
                            <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-amber-100 text-amber-800">
                                <i class="bi bi-exclamation-circle-fill mr-2"></i>
                                {{ $report->kategori }}
                            </span>
                        </div>
                    </div>

                    {{-- Deskripsi Laporan --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-600 mb-3">
                            <i class="bi bi-file-text-fill mr-1.5 text-amber-600"></i>Deskripsi Laporan
                        </label>
                        <div class="p-5 bg-amber-50 border border-amber-200 rounded-xl">
                            <p class="text-slate-700 leading-relaxed">{{ $report->deskripsi }}</p>
                        </div>
                    </div>

                </div>

                {{-- Action Buttons --}}
                <div class="pt-6 border-t border-slate-200 flex gap-3">
                    <a href="{{ route('admin.reports') }}" 
                       class="px-6 py-2.5 bg-slate-200 text-slate-700 font-medium rounded-lg hover:bg-slate-300 transition-all duration-200 flex items-center gap-2">
                        <i class="bi bi-arrow-left"></i>
                        <span>Kembali ke Daftar</span>
                    </a>
                    <button class="px-6 py-2.5 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 shadow-lg shadow-green-500/30 hover:shadow-green-500/50 transition-all duration-300 flex items-center gap-2">
                        <i class="bi bi-check-circle"></i>
                        <span>Tandai Selesai</span>
                    </button>
                </div>

            </div>
        </div>

    </section>

</div>
