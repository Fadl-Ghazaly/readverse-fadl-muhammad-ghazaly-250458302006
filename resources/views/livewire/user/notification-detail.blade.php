<div class="min-h-screen bg-slate-50 pb-12">
    
    {{-- Header Section --}}
    <div class="bg-white border-b border-slate-200 mb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800 flex items-center gap-2">
                        <i class="bi bi-bell-fill text-indigo-600"></i>
                        Detail Notifikasi
                    </h1>
                    <p class="text-slate-500 mt-1">Informasi lengkap mengenai notifikasi Anda</p>
                </div>
                
                <nav class="flex" aria-label="Breadcrumb">
                    <ol class="inline-flex items-center space-x-1 md:space-x-3">
                        <li class="inline-flex items-center">
                            <a href="{{ route('user.homepage') }}" class="inline-flex items-center text-sm font-medium text-slate-500 hover:text-indigo-600 transition-colors">
                                <i class="bi bi-house-door-fill mr-2"></i>
                                Home
                            </a>
                        </li>
                        <li><i class="bi bi-chevron-right text-slate-400 text-xs mx-1"></i></li>
                        <li class="inline-flex items-center">
                            <a href="{{ route('user.notifications') }}" class="text-slate-500 hover:text-indigo-600 text-sm font-medium">Notifikasi</a>
                        </li>
                        <li><i class="bi bi-chevron-right text-slate-400 text-xs mx-1"></i></li>
                        <li class="text-slate-400 text-sm font-medium">Detail</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="mb-6">
            <a href="{{ route('user.notifications') }}" class="inline-flex items-center text-sm font-medium text-slate-600 hover:text-indigo-600 transition-colors">
                <i class="bi bi-arrow-left mr-2"></i>
                Kembali ke Daftar Notifikasi
            </a>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 bg-gradient-to-r from-indigo-50 to-white flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-indigo-100 flex items-center justify-center text-indigo-600">
                        <i class="bi bi-info-circle-fill text-lg"></i>
                    </div>
                    <div>
                        <h3 class="font-bold text-slate-800">Pesan Notifikasi</h3>
                        <p class="text-xs text-slate-500">{{ $notification->sent_at->format('d M Y, H:i') }}</p>
                    </div>
                </div>
                
                <button wire:click="delete" 
                        onclick="return confirm('Hapus notifikasi ini?')"
                        class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all"
                        title="Hapus Notifikasi">
                    <i class="bi bi-trash text-lg"></i>
                </button>
            </div>
            
            <div class="p-6 md:p-8">
                <div class="prose prose-slate max-w-none mb-6">
                    <p class="text-lg text-slate-800 leading-relaxed font-medium">
                        {{ $notification->message }}
                    </p>
                </div>

                @if($notification->data)
                    <div class="bg-slate-50 rounded-xl border border-slate-200 p-4">
                        <h4 class="text-xs font-bold text-slate-500 uppercase tracking-wider mb-2">Detail Data</h4>
                        <pre class="text-xs text-slate-700 overflow-x-auto font-mono bg-white p-3 rounded-lg border border-slate-100 shadow-sm">{{ json_encode($notification->data, JSON_PRETTY_PRINT) }}</pre>
                    </div>
                @endif
            </div>
            
            <div class="px-6 py-4 bg-slate-50 border-t border-slate-100 flex justify-end">
                <a href="{{ route('user.notifications') }}" class="px-4 py-2 bg-white border border-slate-200 text-slate-600 rounded-xl hover:bg-slate-50 hover:text-indigo-600 transition-colors text-sm font-medium shadow-sm">
                    Tutup
                </a>
            </div>
        </div>

    </div>
</div>
