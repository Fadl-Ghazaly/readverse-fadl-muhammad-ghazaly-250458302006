<div class="p-6 lg:p-8">
    
    {{-- Page Title --}}
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Kirim Notifikasi</h1>
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
                                <span class="ml-1 text-sm font-medium text-slate-400 md:ml-2">Notifikasi</span>
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
        <div class="max-w-3xl">

            {{-- Success Alert --}}
            @if (session()->has('success'))
                <div class="mb-6 flex items-center p-4 bg-green-50 border border-green-200 rounded-xl text-green-800" role="alert">
                    <i class="bi bi-check-circle-fill text-green-500 text-xl mr-3"></i>
                    <span>{{ session('success') }}</span>
                    <button type="button" class="ml-auto text-green-500 hover:text-green-700" onclick="this.parentElement.remove()">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
            @endif

            {{-- Notification Form Card --}}
            <div class="bg-gradient-to-br from-white to-purple-50 rounded-2xl shadow-sm border border-purple-100 overflow-hidden">
                
                {{-- Header --}}
                <div class="p-6 bg-gradient-to-r from-purple-600 to-indigo-600">
                    <div class="flex items-center gap-3">
                        <div class="p-3 bg-white/20 backdrop-blur-sm rounded-xl">
                            <i class="bi bi-megaphone-fill text-white text-2xl"></i>
                        </div>
                        <div>
                            <h5 class="text-xl font-bold text-white">Broadcast Notifikasi</h5>
                            <p class="text-sm text-purple-100 mt-1">Kirim notifikasi ke pengguna aplikasi</p>
                        </div>
                    </div>
                </div>

                {{-- Form --}}
                <div class="p-6 space-y-6">

                    {{-- Penerima --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            <i class="bi bi-people-fill mr-1.5 text-purple-600"></i>Penerima
                            <span class="text-red-500">*</span>
                        </label>
                        <select wire:model="user_id" 
                                class="w-full px-4 py-3 border border-slate-200 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all">
                            <option value="all">📢 Semua User (Broadcast)</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">
                                    👤 {{ $user->name }} ({{ $user->email }})
                                </option>
                            @endforeach
                        </select>
                        <p class="mt-2 text-xs text-slate-500">
                            <i class="bi bi-info-circle mr-1"></i>
                            Pilih "Semua User" untuk mengirim ke semua pengguna
                        </p>
                    </div>

                    {{-- Tipe Notifikasi --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            <i class="bi bi-tag-fill mr-1.5 text-purple-600"></i>Tipe Notifikasi
                        </label>
                        <input type="text" 
                               wire:model="type" 
                               class="w-full px-4 py-3 border border-slate-200 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all placeholder-slate-400"
                               placeholder="Contoh: system, novel_update, promo">
                        <p class="mt-2 text-xs text-slate-500">
                            <i class="bi bi-lightbulb mr-1"></i>
                            Tipe notifikasi untuk kategori pesan (opsional)
                        </p>
                    </div>

                    {{-- Pesan --}}
                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">
                            <i class="bi bi-chat-text-fill mr-1.5 text-purple-600"></i>Pesan Notifikasi
                            <span class="text-red-500">*</span>
                        </label>
                        <textarea wire:model="message" 
                                  rows="5"
                                  class="w-full px-4 py-3 border border-slate-200 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all placeholder-slate-400 resize-none"
                                  placeholder="Tulis pesan notifikasi yang akan dikirim..."></textarea>
                        <div class="mt-2 flex items-center justify-between">
                            <p class="text-xs text-slate-500">
                                <i class="bi bi-info-circle mr-1"></i>
                                Tulis pesan yang jelas dan informatif
                            </p>
                            <span class="text-xs text-slate-400" x-data="{ count: $wire.entangle('message').live }" x-text="(count || '').length + '/500'">0/500</span>
                        </div>
                    </div>

                    {{-- Preview Box --}}
                    <div x-show="$wire.message" x-transition class="p-4 bg-purple-50 border border-purple-200 rounded-xl">
                        <p class="text-xs font-semibold text-purple-700 mb-2">
                            <i class="bi bi-eye mr-1"></i>Preview Notifikasi:
                        </p>
                        <div class="flex items-start gap-3 p-3 bg-white rounded-lg shadow-sm">
                            <i class="bi bi-bell-fill text-purple-600 text-lg mt-1"></i>
                            <div class="flex-1">
                                <p class="text-sm text-slate-800" x-text="$wire.message || 'Pesan akan muncul di sini...'"></p>
                                <p class="text-xs text-slate-500 mt-1">Baru saja</p>
                            </div>
                        </div>
                    </div>

                    {{-- Action Buttons --}}
                    <div class="pt-4 border-t border-purple-100">
                        <button wire:click="send" 
                                class="w-full px-6 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 text-white font-medium rounded-lg hover:from-purple-700 hover:to-indigo-700 shadow-lg shadow-purple-500/30 hover:shadow-purple-500/50 transition-all duration-300 flex items-center justify-center gap-2">
                            <i class="bi bi-send-fill"></i>
                            <span>Kirim Notifikasi Sekarang</span>
                        </button>
                        <p class="mt-3 text-center text-xs text-slate-500">
                            <i class="bi bi-shield-check mr-1"></i>
                            Notifikasi akan langsung terkirim ke penerima yang dipilih
                        </p>
                    </div>

                </div>

            </div>

            {{-- Info Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mt-6">
                <div class="bg-white rounded-xl p-4 border border-slate-100">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center">
                            <i class="bi bi-person-check-fill text-blue-600"></i>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500">Total User</p>
                            <p class="text-lg font-bold text-slate-800">{{ $users->count() }}</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-4 border border-slate-100">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center">
                            <i class="bi bi-bell-fill text-purple-600"></i>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500">Mode</p>
                            <p class="text-sm font-semibold text-slate-800" x-data x-text="$wire.user_id === 'all' ? 'Broadcast' : 'Personal'">Broadcast</p>
                        </div>
                    </div>
                </div>
                <div class="bg-white rounded-xl p-4 border border-slate-100">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 bg-green-100 rounded-lg flex items-center justify-center">
                            <i class="bi bi-clock-history text-green-600"></i>
                        </div>
                        <div>
                            <p class="text-xs text-slate-500">Pengiriman</p>
                            <p class="text-sm font-semibold text-slate-800">Real-time</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

</div>
