<aside id="sidebar" class="fixed left-0 top-16 bottom-0 w-64 bg-white border-r border-slate-200 transform transition-transform duration-300 z-40 overflow-y-auto lg:translate-x-0" :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">
    <ul class="p-4 space-y-1">

        <!-- Home -->
        <li>
            <a href="{{ route('user.homepage') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('user.homepage') ? 'bg-indigo-50 text-indigo-600 font-semibold shadow-sm shadow-indigo-100' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <i class="bi bi-grid text-lg {{ request()->routeIs('user.homepage') ? 'text-indigo-600' : 'text-slate-400 group-hover:text-indigo-500' }}"></i>
                <span>Home</span>
            </a>
        </li>

        <li class="px-4 pt-4 pb-2 text-xs font-semibold text-slate-400 uppercase tracking-wider">
            Menu
        </li>

        <!-- Novels -->
        <li>
            <a href="{{ route('user.novels') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('user.novels') ? 'bg-indigo-50 text-indigo-600 font-semibold shadow-sm shadow-indigo-100' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <i class="bi bi-book text-lg {{ request()->routeIs('user.novels') ? 'text-indigo-600' : 'text-slate-400 group-hover:text-indigo-500' }}"></i>
                <span>Novels</span>
            </a>
        </li>

        <!-- Bookmarks -->
        <li>
            <a href="{{ route('user.bookmarks') }}" 
               class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all duration-200 group {{ request()->routeIs('user.bookmarks') ? 'bg-indigo-50 text-indigo-600 font-semibold shadow-sm shadow-indigo-100' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                <i class="bi bi-bookmarks text-lg {{ request()->routeIs('user.bookmarks') ? 'text-indigo-600' : 'text-slate-400 group-hover:text-indigo-500' }}"></i>
                <span>Bookmarks</span>
            </a>
        </li>

    </ul>
</aside>