<div class="min-h-screen bg-slate-50 pb-12">
    
    {{-- Header Section --}}
    <div class="bg-white border-b border-slate-200 mb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800 flex items-center gap-2">
                        <i class="bi bi-bell-fill text-indigo-600"></i>
                        Notifikasi
                    </h1>
                    <p class="text-slate-500 mt-1">Pantau semua aktivitas dan pembaruan terbaru</p>
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
                                <span class="ml-1 text-sm font-medium text-slate-400 md:ml-2">Notifikasi</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 bg-slate-50/50 flex items-center justify-between">
                <h3 class="font-bold text-slate-800 flex items-center gap-2">
                    <i class="bi bi-list-ul text-indigo-600"></i>
                    Daftar Notifikasi
                </h3>
                
                @if($notifications->isNotEmpty())
                    <button wire:click="deleteAll" 
                            onclick="return confirm('Hapus semua notifikasi?')"
                            class="text-xs font-medium text-red-600 hover:text-red-700 hover:bg-red-50 px-3 py-1.5 rounded-lg transition-colors flex items-center gap-1">
                        <i class="bi bi-trash"></i>
                        Hapus Semua
                    </button>
                @endif
            </div>

            @if($notifications->isEmpty())
                <div class="text-center py-16">
                    <div class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="bi bi-bell-slash text-3xl text-slate-300"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-slate-700">Tidak ada notifikasi</h3>
                    <p class="text-slate-500 mt-1 text-sm">Anda akan melihat pembaruan di sini.</p>
                </div>
            @else
                <div class="divide-y divide-slate-100">
                    @foreach($notifications as $notif)
                        <div class="group p-4 hover:bg-slate-50 transition-colors flex gap-4">
                            {{-- Icon --}}
                            <div class="flex-shrink-0 mt-1">
                                <div class="w-10 h-10 rounded-full bg-indigo-50 text-indigo-600 flex items-center justify-center text-lg">
                                    <i class="bi bi-info-circle-fill"></i>
                                </div>
                            </div>

                            {{-- Content --}}
                            <div class="flex-1 min-w-0">
                                <div class="flex items-start justify-between gap-4">
                                    <a href="{{ route('user.notification.detail', $notif->id) }}" class="block group-hover:text-indigo-600 transition-colors">
                                        <p class="text-sm font-semibold text-slate-800 mb-1">
                                            {{ $notif->message }}
                                        </p>
                                        <p class="text-xs text-slate-500">
                                            {{ $notif->sent_at->diffForHumans() }}
                                        </p>
                                    </a>

                                    <button wire:click="delete({{ $notif->id }})" 
                                            class="p-1.5 text-slate-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all opacity-0 group-hover:opacity-100"
                                            title="Hapus">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="px-6 py-4 border-t border-slate-100 bg-slate-50/30">
                    {{ $notifications->links() }}
                </div>
            @endif
        </div>

    </div>
</div>
