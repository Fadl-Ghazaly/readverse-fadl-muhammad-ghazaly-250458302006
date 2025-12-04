<div class="absolute right-0 mt-2 w-80 bg-white rounded-2xl shadow-xl border border-slate-100 py-2 z-50 origin-top-right animate-fade-in-up" 
     x-show="notificationsOpen" 
     @click.outside="notificationsOpen = false"
     style="display: none;">
    
    <div class="px-4 py-3 border-b border-slate-100 flex items-center justify-between">
        <h3 class="text-sm font-bold text-slate-800">Notifikasi</h3>
        @if(!$recent->isEmpty())
            <span class="text-[10px] font-medium px-2 py-0.5 rounded-full bg-indigo-50 text-indigo-600">
                {{ $recent->count() }} Baru
            </span>
        @endif
    </div>

    <div class="max-h-[300px] overflow-y-auto">
        @if($recent->isEmpty())
            <div class="px-4 py-8 text-center">
                <div class="w-10 h-10 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-2">
                    <i class="bi bi-bell-slash text-slate-400"></i>
                </div>
                <p class="text-xs text-slate-500">Tidak ada notifikasi baru</p>
            </div>
        @else
            <ul class="divide-y divide-slate-50">
                @foreach($recent as $notif)
                    <li>
                        <a href="{{ route('user.notification.detail', $notif->id) }}" 
                           class="block px-4 py-3 hover:bg-slate-50 transition-colors group">
                            <div class="flex gap-3">
                                <div class="flex-shrink-0 mt-1">
                                    <div class="w-8 h-8 rounded-full bg-indigo-50 text-indigo-600 flex items-center justify-center text-sm">
                                        <i class="bi bi-info-circle-fill"></i>
                                    </div>
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-medium text-slate-800 group-hover:text-indigo-600 transition-colors line-clamp-2">
                                        {{ $notif->message }}
                                    </p>
                                    <p class="text-xs text-slate-400 mt-1">
                                        {{ $notif->sent_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

    <div class="px-4 py-2 border-t border-slate-100 bg-slate-50/50">
        <a href="{{ route('user.notifications') }}" 
           class="block text-center text-xs font-medium text-indigo-600 hover:text-indigo-700 transition-colors py-1">
            Lihat Semua Notifikasi
        </a>
    </div>
</div>
