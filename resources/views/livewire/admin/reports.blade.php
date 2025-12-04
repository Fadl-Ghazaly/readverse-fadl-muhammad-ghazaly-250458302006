<div class="p-6 lg:p-8">
    
    {{-- Page Title --}}
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Kelola Laporan</h1>
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
                                <span class="ml-1 text-sm font-medium text-slate-400 md:ml-2">Laporan</span>
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

        @forelse($reports as $report)
            {{-- Report Card --}}
            <div class="mb-4 bg-white rounded-2xl shadow-sm border-l-4 border-amber-500 hover:shadow-md transition-shadow">
                <div class="p-6">
                    
                    {{-- Header --}}
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex items-center gap-3">
                            <div class="w-12 h-12 bg-amber-100 rounded-xl flex items-center justify-center">
                                <i class="bi bi-exclamation-triangle-fill text-amber-600 text-xl"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-slate-800">{{ $report->kategori }}</h3>
                                <p class="text-sm text-slate-500">
                                    <i class="bi bi-clock mr-1"></i>{{ $report->created_at->diffForHumans() }}
                                </p>
                            </div>
                        </div>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-amber-100 text-amber-800">
                            <span class="w-1.5 h-1.5 mr-1.5 bg-amber-500 rounded-full"></span>
                            {{ $report->status }}
                        </span>
                    </div>

                    {{-- Details Grid --}}
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <div>
                            <p class="text-xs text-slate-500 mb-1">Pelapor</p>
                            <div class="flex items-center gap-2">
                                <div class="w-8 h-8 bg-gradient-to-br from-slate-500 to-slate-700 rounded-full flex items-center justify-center text-white font-bold text-xs">
                                    {{ substr($report->user->name, 0, 1) }}
                                </div>
                                <span class="font-medium text-slate-800">{{ $report->user->name }}</span>
                            </div>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 mb-1">Tipe Target</p>
                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-medium bg-slate-100 text-slate-700">
                                {{ $report->target_type_name }}
                            </span>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500 mb-1">Target</p>
                            <p class="font-medium text-slate-800">{{ $report->target_title }}</p>
                        </div>
                    </div>

                    {{-- Description --}}
                    <div class="bg-slate-50 rounded-lg p-4 mb-4">
                        <p class="text-sm text-slate-700">{{ $report->deskripsi }}</p>
                    </div>

                    {{-- Action Button --}}
                    <div class="flex justify-end">
                        <a href="{{ route('admin.report.detail', $report->id) }}"
                           class="inline-flex items-center px-4 py-2 bg-amber-600 text-white font-medium rounded-lg hover:bg-amber-700 shadow-md shadow-amber-500/30 hover:shadow-amber-500/50 transition-all duration-200">
                            <i class="bi bi-eye mr-2"></i>
                            Lihat Detail
                        </a>
                    </div>

                </div>
            </div>

        @empty

            {{-- Empty State --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100">
                <div class="p-12 text-center">
                    <div class="w-20 h-20 bg-green-50 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="bi bi-check-circle text-4xl text-green-500"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-slate-700 mb-2">Tidak Ada Laporan</h3>
                    <p class="text-slate-500">Belum ada laporan dari pengguna. Sistem berjalan dengan baik!</p>
                </div>
            </div>

        @endforelse

    </section>

</div>
