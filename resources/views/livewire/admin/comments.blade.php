<div class="p-6 lg:p-8">
    
    {{-- Page Title --}}
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Kelola Komentar</h1>
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
                                <span class="ml-1 text-sm font-medium text-slate-400 md:ml-2">Kelola Komentar</span>
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
        <div class="bg-white rounded-2xl shadow-sm border border-slate-100">
            <div class="p-6">

                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-blue-50 rounded-lg">
                            <i class="bi bi-chat-square-text-fill text-blue-600 text-xl"></i>
                        </div>
                        <div>
                            <h5 class="text-lg font-bold text-slate-800">Daftar Novel dengan Komentar</h5>
                            <p class="text-sm text-slate-500 mt-0.5">Kelola komentar pada setiap novel</p>
                        </div>
                    </div>
                </div>

                @if ($novels->count())
                    {{-- Table --}}
                    <div class="overflow-x-auto rounded-xl border border-slate-200">
                        <table class="w-full text-sm text-left">
                            <thead class="text-xs text-slate-700 uppercase bg-slate-50 border-b border-slate-200">
                                <tr>
                                    <th scope="col" class="px-6 py-3 font-semibold">Novel</th>
                                    <th scope="col" class="px-6 py-3 font-semibold">Total Komentar</th>
                                    <th scope="col" class="px-6 py-3 font-semibold text-center">Aksi</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($novels as $novel)
                                    <tr class="bg-white border-b border-slate-100 hover:bg-slate-50 transition-colors">
                                        <td class="px-6 py-4 font-medium text-slate-900">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-lg flex items-center justify-center text-white font-bold">
                                                    {{ substr($novel->title, 0, 1) }}
                                                </div>
                                                <div>
                                                    <div class="font-semibold">{{ $novel->title }}</div>
                                                    @if($novel->author)
                                                        <div class="text-xs text-slate-500">oleh {{ $novel->author }}</div>
                                                    @endif
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                                                <i class="bi bi-chat-dots-fill mr-1.5"></i>
                                                {{ $novel->comments_count }} Komentar
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex justify-center">
                                                <a href="{{ route('admin.comment.detail', $novel->id) }}"
                                                   class="inline-flex items-center px-4 py-2 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 shadow-md shadow-blue-500/30 hover:shadow-blue-500/50 transition-all duration-200">
                                                    <i class="bi bi-chat-square-text mr-2"></i>
                                                    Lihat Detail
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>

                        </table>
                    </div>
                @else
                    {{-- Empty State --}}
                    <div class="py-12 text-center">
                        <div class="flex flex-col items-center">
                            <div class="w-20 h-20 bg-blue-50 rounded-full flex items-center justify-center mb-4">
                                <i class="bi bi-chat-text text-4xl text-blue-400"></i>
                            </div>
                            <h3 class="text-lg font-semibold text-slate-700 mb-2">Belum Ada Komentar</h3>
                            <p class="text-slate-500">Novel Anda belum memiliki komentar dari pengguna.</p>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </section>

</div>
