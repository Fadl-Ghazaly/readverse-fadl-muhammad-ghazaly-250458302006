<div class="p-6 lg:p-8">
    
    {{-- Page Title --}}
    <div class="mb-8">
        <div>
            <h1 class="text-2xl font-bold text-slate-800">Hasil Pencarian: "{{ $query }}"</h1>
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
                            <span class="ml-1 text-sm font-medium text-slate-400 md:ml-2">Pencarian</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>
    </div>

    <section class="space-y-6">

        @if(empty($novels) && empty($episodes) && empty($genres) && empty($comments) && empty($users))
            {{-- Empty State --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100">
                <div class="p-12 text-center">
                    <div class="w-20 h-20 bg-slate-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i class="bi bi-search text-4xl text-slate-400"></i>
                    </div>
                    <h3 class="text-lg font-semibold text-slate-700 mb-2">Tidak Ada Hasil</h3>
                    <p class="text-slate-500">Tidak ditemukan hasil untuk "<strong>{{ $query }}</strong>"</p>
                    <p class="text-sm text-slate-400 mt-1">Coba gunakan kata kunci lain</p>
                </div>
            </div>
        @else

            {{-- Novel Results --}}
            @if($novels->isNotEmpty())
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100">
                    <div class="p-6 border-b border-slate-200">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-indigo-100 rounded-lg flex items-center justify-center">
                                <i class="bi bi-book-fill text-indigo-600"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-slate-800">Novel</h3>
                                <p class="text-sm text-slate-500">{{ $novels->total() }} hasil ditemukan</p>
                            </div>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="text-xs text-slate-700 uppercase bg-slate-50 border-b border-slate-200">
                                <tr>
                                    <th scope="col" class="px-6 py-3 font-semibold">Judul</th>
                                    <th scope="col" class="px-6 py-3 font-semibold">Penulis</th>
                                    <th scope="col" class="px-6 py-3 font-semibold">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($novels as $n)
                                    <tr class="bg-white border-b border-slate-100 hover:bg-indigo-50 transition-colors">
                                        <td class="px-6 py-4">
                                            <a href="{{ route('admin.novels', $n->id) }}" class="font-medium text-indigo-600 hover:text-indigo-700">
                                                {{ $n->title }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4 text-slate-600">{{ $n->author ?? '-' }}</td>
                                        <td class="px-6 py-4">
                                            @if($n->status === 'active')
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                                    <span class="w-1.5 h-1.5 mr-1.5 bg-green-500 rounded-full"></span>
                                                    Aktif
                                                </span>
                                            @else
                                                <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-red-100 text-red-800">
                                                    <span class="w-1.5 h-1.5 mr-1.5 bg-red-500 rounded-full"></span>
                                                    Nonaktif
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="p-4">
                        {{ $novels->links() }}
                    </div>
                </div>
            @endif

            {{-- Episode Results --}}
            @if($episodes->isNotEmpty())
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100">
                    <div class="p-6 border-b border-slate-200">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                                <i class="bi bi-film text-blue-600"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-slate-800">Episode</h3>
                                <p class="text-sm text-slate-500">{{ $episodes->total() }} hasil ditemukan</p>
                            </div>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="text-xs text-slate-700 uppercase bg-slate-50 border-b border-slate-200">
                                <tr>
                                    <th scope="col" class="px-6 py-3 font-semibold">Judul</th>
                                    <th scope="col" class="px-6 py-3 font-semibold">Novel</th>
                                    <th scope="col" class="px-6 py-3 font-semibold">Nomor</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($episodes as $e)
                                    <tr class="bg-white border-b border-slate-100 hover:bg-blue-50 transition-colors">
                                        <td class="px-6 py-4">
                                            <a href="{{ route('admin.episodes', $e->id) }}" class="font-medium text-blue-600 hover:text-blue-700">
                                                {{ $e->judul }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="{{ route('admin.novels', $e->novel->id) }}" class="text-slate-600 hover:text-indigo-600">
                                                {{ $e->novel->title }}
                                            </a>
                                        </td>
                                        <td class="px-6 py-4 text-slate-600">#{{ $e->episode_number }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="p-4">
                        {{ $episodes->links() }}
                    </div>
                </div>
            @endif

            {{-- Genre Results --}}
            @if($genres->isNotEmpty())
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100">
                    <div class="p-6 border-b border-slate-200">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-orange-100 rounded-lg flex items-center justify-center">
                                <i class="bi bi-tag-fill text-orange-600"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-slate-800">Genre</h3>
                                <p class="text-sm text-slate-500">{{ $genres->total() }} hasil ditemukan</p>
                            </div>
                        </div>
                    </div>
                    <div class="p-6">
                        <div class="flex flex-wrap gap-3">
                            @foreach($genres as $g)
                                <a href="{{ route('admin.genres', $g->id) }}" 
                                   class="inline-flex items-center px-4 py-2 rounded-full text-sm font-medium bg-orange-100 text-orange-800 hover:bg-orange-200 transition-colors">
                                    <i class="bi bi-tag-fill mr-1.5 text-xs"></i>
                                    {{ $g->nama }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="p-4 border-t border-slate-200">
                        {{ $genres->links() }}
                    </div>
                </div>
            @endif

            {{-- Comment Results --}}
            @if($comments->isNotEmpty())
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100">
                    <div class="p-6 border-b border-slate-200">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                                <i class="bi bi-chat-dots-fill text-green-600"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-slate-800">Komentar</h3>
                                <p class="text-sm text-slate-500">{{ $comments->total() }} hasil ditemukan</p>
                            </div>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="text-xs text-slate-700 uppercase bg-slate-50 border-b border-slate-200">
                                <tr>
                                    <th scope="col" class="px-6 py-3 font-semibold">Komentar</th>
                                    <th scope="col" class="px-6 py-3 font-semibold">User</th>
                                    <th scope="col" class="px-6 py-3 font-semibold">Novel</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($comments as $c)
                                    <tr class="bg-white border-b border-slate-100 hover:bg-green-50 transition-colors">
                                        <td class="px-6 py-4 text-slate-700">{{ \Illuminate\Support\Str::limit($c->comment, 50) }}</td>
                                        <td class="px-6 py-4 text-slate-600">{{ $c->user->name ?? 'Unknown' }}</td>
                                        <td class="px-6 py-4">
                                            @if($c->novel)
                                                <a href="{{ route('admin.novels', $c->novel->id) }}" class="text-indigo-600 hover:text-indigo-700">
                                                    {{ $c->novel->title }}
                                                </a>
                                            @else
                                                <em class="text-slate-400">Novel dihapus</em>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="p-4">
                        {{ $comments->links() }}
                    </div>
                </div>
            @endif

            {{-- User Results --}}
            @if($users->isNotEmpty())
                <div class="bg-white rounded-2xl shadow-sm border border-slate-100">
                    <div class="p-6 border-b border-slate-200">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                                <i class="bi bi-people-fill text-purple-600"></i>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-slate-800">User</h3>
                                <p class="text-sm text-slate-500">{{ $users->total() }} hasil ditemukan</p>
                            </div>
                        </div>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <thead class="text-xs text-slate-700 uppercase bg-slate-50 border-b border-slate-200">
                                <tr>
                                    <th scope="col" class="px-6 py-3 font-semibold">Nama</th>
                                    <th scope="col" class="px-6 py-3 font-semibold">Email</th>
                                    <th scope="col" class="px-6 py-3 font-semibold">Role</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $u)
                                    <tr class="bg-white border-b border-slate-100 hover:bg-purple-50 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                <div class="w-8 h-8 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-full flex items-center justify-center text-white font-bold text-xs">
                                                    {{ substr($u->name, 0, 1) }}
                                                </div>
                                                <span class="font-medium text-slate-900">{{ $u->name }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-slate-600">{{ $u->email }}</td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800">
                                                {{ ucfirst($u->role) }}
                                            </span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="p-4">
                        {{ $users->links() }}
                    </div>
                </div>
            @endif

        @endif

    </section>

</div>