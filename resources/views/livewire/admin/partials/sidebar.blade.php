<aside id="sidebar" class="fixed left-0 top-16 bottom-0 w-64 bg-white border-r border-slate-200 transform transition-transform duration-300 z-40 overflow-y-auto lg:translate-x-0" :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
    <ul class="p-4 space-y-1">

        <!-- Dashboard -->
        <li>
            <a href="{{ route('dashboard') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('dashboard') ? 'bg-indigo-50 text-indigo-600 font-semibold shadow-sm shadow-indigo-100' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <i class="bi bi-grid text-lg {{ request()->routeIs('dashboard') ? 'text-indigo-600' : 'text-slate-400 group-hover:text-indigo-500' }}"></i>
                <span>Dashboard</span>
            </a>
        </li>

        <li class="px-4 pt-4 pb-2 text-xs font-semibold text-slate-400 uppercase tracking-wider">
            Konten
        </li>

        <!-- Novel -->
        <li>
            <a href="{{ route('admin.novels') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.novels') ? 'bg-indigo-50 text-indigo-600 font-semibold shadow-sm shadow-indigo-100' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <i class="bi bi-book text-lg {{ request()->routeIs('admin.novels') ? 'text-indigo-600' : 'text-slate-400 group-hover:text-indigo-500' }}"></i>
                <span>Novel</span>
            </a>
        </li>

        <!-- Episode -->
        <li>
            <a href="{{ route('admin.episodes') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.episodes') ? 'bg-indigo-50 text-indigo-600 font-semibold shadow-sm shadow-indigo-100' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <i class="bi bi-collection text-lg {{ request()->routeIs('admin.episodes') ? 'text-indigo-600' : 'text-slate-400 group-hover:text-indigo-500' }}"></i>
                <span>Episode</span>
            </a>
        </li>

        <!-- Genre -->
        <li>
            <a href="{{ route('admin.genres') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.genres') ? 'bg-indigo-50 text-indigo-600 font-semibold shadow-sm shadow-indigo-100' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <i class="bi bi-tags text-lg {{ request()->routeIs('admin.genres') ? 'text-indigo-600' : 'text-slate-400 group-hover:text-indigo-500' }}"></i>
                <span>Genre</span>
            </a>
        </li>

        <li class="px-4 pt-4 pb-2 text-xs font-semibold text-slate-400 uppercase tracking-wider">
            Interaksi
        </li>

        <!-- Komentar -->
        <li>
            <a href="{{ route('admin.comments') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.comments') ? 'bg-indigo-50 text-indigo-600 font-semibold shadow-sm shadow-indigo-100' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <i class="bi bi-chat-dots text-lg {{ request()->routeIs('admin.comments') ? 'text-indigo-600' : 'text-slate-400 group-hover:text-indigo-500' }}"></i>
                <span>Komentar</span>
            </a>
        </li>

        <!-- Laporan -->
        <li>
            <a href="{{ route('admin.reports') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.reports') ? 'bg-indigo-50 text-indigo-600 font-semibold shadow-sm shadow-indigo-100' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <i class="bi bi-flag text-lg {{ request()->routeIs('admin.reports') ? 'text-indigo-600' : 'text-slate-400 group-hover:text-indigo-500' }}"></i>
                <span>Laporan</span>
            </a>
        </li>

        <!-- Notifikasi -->
        <li>
            <a href="{{ route('admin.notifications') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('admin.notifications') ? 'bg-indigo-50 text-indigo-600 font-semibold shadow-sm shadow-indigo-100' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <i class="bi bi-bell text-lg {{ request()->routeIs('admin.notifications') ? 'text-indigo-600' : 'text-slate-400 group-hover:text-indigo-500' }}"></i>
                <span>Notifikasi</span>
            </a>
        </li>

    </ul>
</aside>