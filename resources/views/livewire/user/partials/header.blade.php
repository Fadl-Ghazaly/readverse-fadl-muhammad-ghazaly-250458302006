<header id="header" class="fixed top-0 w-full z-50 bg-white/90 backdrop-blur-md border-b border-slate-200 shadow-sm transition-all duration-300 h-16 flex items-center px-4 sm:px-6 lg:px-8">
  <div class="flex items-center justify-between w-full">
    
    <!-- Logo & Sidebar Toggle -->
    <div class="flex items-center gap-4 lg:w-64">
      <a href="{{ route('user.homepage') }}" class="flex items-center gap-2 group">
        <img src="{{ asset('NiceAdmin/assets/img/Logo1.png') }}" alt="Readverse" class="h-8 w-auto transition-transform duration-300 group-hover:scale-110">
        <span class="hidden lg:block font-bold text-xl text-slate-800 tracking-tight">Readverse</span>
      </a>
      <button type="button" @click="sidebarOpen = !sidebarOpen" class="text-slate-500 hover:text-indigo-600 transition-colors p-1 rounded-md hover:bg-slate-100 toggle-sidebar-btn lg:hidden">
        <i class="bi bi-list text-2xl"></i>
      </button>
    </div>

    <!-- Search Bar -->
    <div class="hidden md:block flex-1 max-w-md mx-4">
      <form action="{{ route('user.search-results') }}" method="GET" class="relative">
        <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
          <i class="bi bi-search text-slate-400"></i>
        </div>
        <input type="text" 
               name="q"
               placeholder="Cari novel, episode, genre..."
               class="block w-full pl-10 pr-4 py-2 border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all bg-slate-50 focus:bg-white">
      </form>
    </div>

    <!-- Right Navigation -->
    <nav class="flex items-center gap-4 ml-auto">
      
      <!-- Mobile Search Toggle -->
      <div class="md:hidden" x-data="{ searchOpen: false }">
        <button @click="searchOpen = !searchOpen" class="text-slate-500 hover:text-indigo-600 p-2 rounded-full hover:bg-slate-100 transition-colors">
          <i class="bi bi-search text-lg"></i>
        </button>
        
        <!-- Mobile Search Input -->
        <div x-show="searchOpen" 
             @click.away="searchOpen = false"
             class="absolute top-16 left-0 w-full bg-white p-4 shadow-md border-b border-slate-200 z-50">
          <form action="{{ route('user.search-results') }}" method="GET" class="relative">
            <input type="text" 
                   name="q"
                   placeholder="Cari..."
                   class="block w-full px-4 py-2 border border-slate-300 rounded-lg text-sm focus:ring-2 focus:ring-indigo-500 focus:border-transparent">
          </form>
        </div>
      </div>

      <!-- Notifications -->
      <div class="relative" x-data="{ open: false }">
        <button @click="open = !open" @click.away="open = false" class="relative text-slate-500 hover:text-indigo-600 p-2 rounded-full hover:bg-slate-100 transition-colors">
          <i class="bi bi-bell text-xl"></i>
          @php($unread = \App\Models\Notification::forUser(auth()->id())->where('is_read', false)->count())
          @if($unread > 0)
            <span class="absolute top-1 right-1 flex h-2.5 w-2.5">
              <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-red-400 opacity-75"></span>
              <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-red-500"></span>
            </span>
          @endif
        </button>

        <!-- Dropdown -->
        <div x-show="open" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-75"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="absolute right-0 mt-2 w-80 bg-white rounded-xl shadow-lg border border-slate-100 py-2 z-50" 
             style="display: none;">
          
          <div class="px-4 py-2 border-b border-slate-50 flex justify-between items-center">
            <h6 class="font-semibold text-slate-800">Notifikasi</h6>
            <a href="{{ route('user.notifications') }}" class="text-xs text-indigo-600 hover:text-indigo-800 font-medium">Lihat Semua</a>
          </div>
          
          <div class="max-h-64 overflow-y-auto">
            <div class="px-4 py-8 text-center text-slate-500 text-sm">
              <i class="bi bi-bell-slash text-2xl mb-2 block opacity-50"></i>
              Tidak ada notifikasi baru
            </div>
          </div>
        </div>
      </div>

      <!-- Profile -->
      <div class="relative pl-2 border-l border-slate-200" x-data="{ open: false }">
        <button @click="open = !open" @click.away="open = false" class="flex items-center gap-3 focus:outline-none group">
          @if(auth()->user()->profile_photo)
            <img src="{{ asset('storage/'.auth()->user()->profile_photo) }}" alt="Profile" class="h-9 w-9 rounded-full object-cover border-2 border-white shadow-sm group-hover:border-indigo-100 transition-all">
          @else
            <div class="h-9 w-9 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold text-sm border-2 border-white shadow-sm group-hover:border-indigo-100 transition-all">
              {{ substr(auth()->user()->name, 0, 1) }}
            </div>
          @endif
          
          <div class="hidden md:block text-left">
            <span class="block text-sm font-semibold text-slate-700 group-hover:text-indigo-600 transition-colors">{{ auth()->user()->name }}</span>
            <span class="block text-xs text-slate-500 capitalize">{{ auth()->user()->role }}</span>
          </div>
          <i class="bi bi-chevron-down text-xs text-slate-400 group-hover:text-indigo-500 transition-colors hidden md:block"></i>
        </button>

        <!-- Dropdown -->
        <div x-show="open" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-75"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             class="absolute right-0 mt-2 w-56 bg-white rounded-xl shadow-lg border border-slate-100 py-1 z-50" 
             style="display: none;">
          
          <div class="px-4 py-3 border-b border-slate-50 md:hidden">
            <p class="text-sm font-semibold text-slate-800">{{ auth()->user()->name }}</p>
            <p class="text-xs text-slate-500 capitalize">{{ auth()->user()->role }}</p>
          </div>

          <a href="{{ route('user.profiles') }}" class="flex items-center gap-2 px-4 py-2.5 text-sm text-slate-700 hover:bg-indigo-50 hover:text-indigo-600 transition-colors">
            <i class="bi bi-person text-lg"></i>
            <span>Profil Saya</span>
          </a>
          
          <div class="border-t border-slate-50 my-1"></div>
          
          <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="w-full flex items-center gap-2 px-4 py-2.5 text-sm text-red-600 hover:bg-red-50 transition-colors">
              <i class="bi bi-box-arrow-right text-lg"></i>
              <span>Logout</span>
            </button>
          </form>
        </div>
      </div>

    </nav>
  </div>
</header>