<div class="relative" x-data="{ open: false }">
  <div class="relative">
    <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
      <i class="bi bi-search text-slate-400"></i>
    </div>
    <input
      type="text"
      class="block w-full pl-10 pr-3 py-2 border border-slate-300 rounded-lg text-sm placeholder-slate-400 focus:ring-2 focus:ring-indigo-500 focus:border-transparent transition-all"
      placeholder="Cari di seluruh sistem..."
      wire:model.live.debounce.500ms="query"
      wire:keydown.enter="redirectToResults"
      @focus="open = true"
      @click.outside="open = false"
    />
  </div>

  @if(!empty($results))
    <div class="absolute z-50 w-full mt-2 bg-white rounded-xl shadow-lg border border-slate-200 max-h-96 overflow-y-auto"
         x-show="open"
         x-transition:enter="transition ease-out duration-100"
         x-transition:enter-start="opacity-0 scale-95"
         x-transition:enter-end="opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="opacity-100 scale-100"
         x-transition:leave-end="opacity-0 scale-95">

      {{-- Novel --}}
      @if(!empty($results['novels']))
        <div class="px-3 py-2 bg-slate-50 border-b border-slate-200">
          <span class="text-xs font-semibold text-slate-600 uppercase tracking-wide">📘 Novel</span>
        </div>
        @foreach($results['novels'] as $n)
          <a href="{{ route('admin.novels') }}" 
             class="flex items-center px-4 py-3 hover:bg-indigo-50 transition-colors border-b border-slate-100 last:border-b-0"
             @click="open = false">
            <div class="w-8 h-8 bg-indigo-100 rounded-lg flex items-center justify-center mr-3">
              <i class="bi bi-book-fill text-indigo-600 text-sm"></i>
            </div>
            <div class="flex-1 min-w-0">
              <p class="text-sm font-medium text-slate-900 truncate">{{ $n->title }}</p>
              @if($n->author)
                <p class="text-xs text-slate-500">oleh {{ $n->author }}</p>
              @endif
            </div>
          </a>
        @endforeach
      @endif

      {{-- Episode --}}
      @if(!empty($results['episodes']))
        <div class="px-3 py-2 bg-slate-50 border-b border-slate-200">
          <span class="text-xs font-semibold text-slate-600 uppercase tracking-wide">🎬 Episode</span>
        </div>
        @foreach($results['episodes'] as $e)
          <a href="{{ route('admin.episodes') }}" 
             class="flex items-center px-4 py-3 hover:bg-blue-50 transition-colors border-b border-slate-100 last:border-b-0"
             @click="open = false">
            <div class="w-8 h-8 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
              <i class="bi bi-film text-blue-600 text-sm"></i>
            </div>
            <div class="flex-1 min-w-0">
              <p class="text-sm font-medium text-slate-900 truncate">Ep {{ $e->episode_number }} — {{ Str::limit($e->judul, 30) }}</p>
            </div>
          </a>
        @endforeach
      @endif

      {{-- Genre --}}
      @if(!empty($results['genres']))
        <div class="px-3 py-2 bg-slate-50 border-b border-slate-200">
          <span class="text-xs font-semibold text-slate-600 uppercase tracking-wide">🏷️ Genre</span>
        </div>
        @foreach($results['genres'] as $g)
          <a href="{{ route('admin.genres') }}" 
             class="flex items-center px-4 py-3 hover:bg-orange-50 transition-colors border-b border-slate-100 last:border-b-0"
             @click="open = false">
            <div class="w-8 h-8 bg-orange-100 rounded-lg flex items-center justify-center mr-3">
              <i class="bi bi-tag-fill text-orange-600 text-sm"></i>
            </div>
            <div class="flex-1 min-w-0">
              <p class="text-sm font-medium text-slate-900 truncate">{{ $g->nama }}</p>
            </div>
          </a>
        @endforeach
      @endif

      {{-- Komentar --}}
      @if(!empty($results['comments']))
        <div class="px-3 py-2 bg-slate-50 border-b border-slate-200">
          <span class="text-xs font-semibold text-slate-600 uppercase tracking-wide">💬 Komentar</span>
        </div>
        @foreach($results['comments'] as $c)
          <a href="{{ route('admin.comments') }}" 
             class="flex items-center px-4 py-3 hover:bg-green-50 transition-colors border-b border-slate-100 last:border-b-0"
             @click="open = false">
            <div class="w-8 h-8 bg-green-100 rounded-lg flex items-center justify-center mr-3">
              <i class="bi bi-chat-dots-fill text-green-600 text-sm"></i>
            </div>
            <div class="flex-1 min-w-0">
              <p class="text-sm text-slate-700 truncate">{{ Str::limit($c->comment, 30) }}</p>
              <p class="text-xs text-slate-500">oleh {{ $c->user->name }}</p>
            </div>
          </a>
        @endforeach
      @endif

      {{-- User --}}
      @if(!empty($results['users']))
        <div class="px-3 py-2 bg-slate-50 border-b border-slate-200">
          <span class="text-xs font-semibold text-slate-600 uppercase tracking-wide">👤 User</span>
        </div>
        @foreach($results['users'] as $u)
          <a href="#" 
             class="flex items-center px-4 py-3 hover:bg-purple-50 transition-colors border-b border-slate-100 last:border-b-0"
             @click="open = false">
            <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-full flex items-center justify-center mr-3 text-white font-bold text-xs">
              {{ substr($u->name, 0, 1) }}
            </div>
            <div class="flex-1 min-w-0">
              <p class="text-sm font-medium text-slate-900 truncate">{{ $u->name }}</p>
            </div>
          </a>
        @endforeach
      @endif

      {{-- View All Link --}}
      <div class="px-4 py-3 bg-slate-50 border-t border-slate-200">
        <a href="{{ route('admin.search-result', ['q' => $query]) }}" 
           class="flex items-center justify-center text-sm font-medium text-indigo-600 hover:text-indigo-700"
           @click="open = false">
          <i class="bi bi-arrow-right-circle mr-2"></i>
          Lihat Semua Hasil ({{ collect($results)->flatten()->count() }})
        </a>
      </div>

    </div>
  @endif
</div>
