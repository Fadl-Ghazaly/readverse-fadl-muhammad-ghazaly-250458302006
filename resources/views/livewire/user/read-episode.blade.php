<div class="min-h-screen bg-slate-50 pb-12">
    
    {{-- Reading Header --}}
    <div class="sticky top-16 z-30 bg-white border-b border-slate-200 shadow-sm">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 h-16 flex items-center justify-between">
            
            <a href="{{ route('user.novel', $episode->novel->slug) }}" 
               class="inline-flex items-center text-sm font-medium text-slate-600 hover:text-indigo-600 transition-colors">
                <i class="bi bi-chevron-left mr-1"></i>
                <span class="hidden sm:inline">Kembali ke Novel</span>
            </a>

            <h1 class="text-lg font-bold text-slate-800 truncate max-w-[200px] sm:max-w-md text-center">
                <span class="text-slate-500 font-normal mr-1">Ep. {{ $episode->episode_number }}:</span>
                {{ $episode->judul }}
            </h1>

            <div class="flex items-center gap-2">
                {{-- Placeholder for Prev/Next buttons if available in future --}}
                <button class="p-2 text-slate-400 hover:text-indigo-600 transition-colors" title="Previous Episode">
                    <i class="bi bi-chevron-left"></i>
                </button>
                <button class="p-2 text-slate-400 hover:text-indigo-600 transition-colors" title="Next Episode">
                    <i class="bi bi-chevron-right"></i>
                </button>
            </div>

        </div>
    </div>

    {{-- Content Area --}}
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        
        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden min-h-[80vh]">
            @if ($episode->file_path)
                <div class="w-full h-[85vh] bg-slate-100">
                    <embed src="{{ asset('storage/' . $episode->file_path) }}#toolbar=0" 
                           type="application/pdf" 
                           class="w-full h-full" />
                </div>
            @else
                <div class="prose prose-lg max-w-none p-8 md:p-12 text-slate-800 leading-relaxed font-serif">
                    {!! nl2br(e($episode->deskripsi)) !!}
                </div>
            @endif
        </div>

        {{-- Footer Actions --}}
        <div class="mt-8 flex justify-center">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 p-1 flex gap-2">
                <button class="px-4 py-2 text-sm font-medium text-slate-600 hover:text-indigo-600 hover:bg-slate-50 rounded-lg transition-colors">
                    <i class="bi bi-chevron-left mr-1"></i> Sebelumnya
                </button>
                <div class="w-px bg-slate-200 my-1"></div>
                <button class="px-4 py-2 text-sm font-medium text-slate-600 hover:text-indigo-600 hover:bg-slate-50 rounded-lg transition-colors">
                    Selanjutnya <i class="bi bi-chevron-right ml-1"></i>
                </button>
            </div>
        </div>

        

        {{-- Report Section --}}
        <div class="mt-12 max-w-2xl mx-auto">
            <div class="bg-white rounded-xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
                    <h3 class="font-bold text-slate-700 text-sm">
                        <i class="bi bi-flag mr-2"></i> Laporkan Masalah
                    </h3>
                </div>
                <div class="p-6">
                    @livewire('user.report-form', [
                        'targetType' => 'episode',
                        'targetId' => $episode->id
                    ])
                </div>
            </div>
        </div>

    </div>
</div>
