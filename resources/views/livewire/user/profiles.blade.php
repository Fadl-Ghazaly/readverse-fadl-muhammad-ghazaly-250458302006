<div class="min-h-screen bg-slate-50 pb-12">
    
    {{-- Header Section --}}
    <div class="bg-white border-b border-slate-200 mb-8">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-slate-800 flex items-center gap-2">
                        <i class="bi bi-person-circle text-indigo-600"></i>
                        Profil Saya
                    </h1>
                    <p class="text-slate-500 mt-1">Kelola informasi akun dan keamanan Anda</p>
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
                                <span class="ml-1 text-sm font-medium text-slate-400 md:ml-2">Profil</span>
                            </div>
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Alerts --}}
        @if (session()->has('message'))
            <div class="mb-6 bg-green-50 border-b border-green-100 px-4 py-3 text-sm text-green-700 flex items-center gap-2 rounded-xl animate-fade-in-down">
                <i class="bi bi-check-circle-fill text-green-500"></i>
                {{ session('message') }}
                <button type="button" class="ml-auto text-green-600 hover:text-green-800" onclick="this.parentElement.remove()">
                    <i class="bi bi-x text-lg"></i>
                </button>
            </div>
        @endif
        @if (session()->has('error'))
            <div class="mb-6 bg-red-50 border-b border-red-100 px-4 py-3 text-sm text-red-700 flex items-center gap-2 rounded-xl animate-fade-in-down">
                <i class="bi bi-exclamation-circle-fill text-red-500"></i>
                {{ session('error') }}
                <button type="button" class="ml-auto text-red-600 hover:text-red-800" onclick="this.parentElement.remove()">
                    <i class="bi bi-x text-lg"></i>
                </button>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            {{-- Profile Information --}}
            <div class="lg:col-span-2">
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 bg-gradient-to-r from-indigo-50 to-white">
                        <h3 class="font-bold text-slate-800 flex items-center gap-2">
                            <i class="bi bi-person-vcard text-indigo-600"></i>
                            Informasi Pribadi
                        </h3>
                    </div>
                    
                    <div class="p-6 md:p-8">
                        <form wire:submit.prevent="updateProfile">
                            
                            {{-- Photo Upload --}}
                            <div class="flex flex-col items-center mb-8">
                                <div class="relative group">
                                    <div class="w-32 h-32 rounded-full overflow-hidden ring-4 ring-slate-100 shadow-md">
                                        @if ($profile_photo && !is_string($profile_photo))
                                            <img src="{{ $profile_photo->temporaryUrl() }}" class="w-full h-full object-cover">
                                        @elseif (auth()->user()->profile_photo)
                                            <img src="{{ asset('storage/'.auth()->user()->profile_photo) }}" class="w-full h-full object-cover">
                                        @else
                                            <div class="w-full h-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white text-4xl font-bold">
                                                {{ substr(auth()->user()->name, 0, 1) }}
                                            </div>
                                        @endif
                                    </div>
                                    
                                    <label for="photo-upload" 
                                           class="absolute bottom-0 right-0 bg-indigo-600 text-white p-2 rounded-full shadow-lg cursor-pointer hover:bg-indigo-700 transition-transform hover:scale-110">
                                        <i class="bi bi-camera-fill"></i>
                                    </label>
                                    <input type="file" id="photo-upload" wire:model="profile_photo" class="hidden" accept="image/*">
                                </div>
                                <span class="text-xs text-slate-400 mt-2">Klik ikon kamera untuk mengubah foto</span>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1">Nama Lengkap</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="bi bi-person text-slate-400"></i>
                                        </div>
                                        <input type="text" wire:model="name" 
                                               class="pl-10 block w-full rounded-xl border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-colors">
                                    </div>
                                    @error('name') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1">Alamat Email</label>
                                    <div class="relative">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <i class="bi bi-envelope text-slate-400"></i>
                                        </div>
                                        <input type="email" wire:model="email" 
                                               class="pl-10 block w-full rounded-xl border-slate-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 transition-colors">
                                    </div>
                                    @error('email') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="mt-8 flex justify-end">
                                <button type="submit" 
                                        class="px-6 py-2.5 bg-indigo-600 text-white font-medium rounded-xl hover:bg-indigo-700 focus:ring-4 focus:ring-indigo-500/30 transition-all shadow-lg shadow-indigo-500/30 flex items-center gap-2">
                                    <i class="bi bi-check-lg"></i>
                                    Simpan Perubahan
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            {{-- Security --}}
            <div>
                <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                    <div class="px-6 py-4 border-b border-slate-100 bg-gradient-to-r from-slate-50 to-white">
                        <h3 class="font-bold text-slate-800 flex items-center gap-2">
                            <i class="bi bi-shield-lock text-slate-600"></i>
                            Keamanan
                        </h3>
                    </div>
                    
                    <div class="p-6">
                        <form wire:submit.prevent="updatePassword" class="space-y-4">
                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Password Saat Ini</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="bi bi-key text-slate-400"></i>
                                    </div>
                                    <input type="password" wire:model="password" 
                                           class="pl-10 block w-full rounded-xl border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500 transition-colors">
                                </div>
                                @error('password') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-medium text-slate-700 mb-1">Password Baru</label>
                                <div class="relative">
                                    <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                        <i class="bi bi-lock text-slate-400"></i>
                                    </div>
                                    <input type="password" wire:model="new_password" 
                                           class="pl-10 block w-full rounded-xl border-slate-300 shadow-sm focus:border-slate-500 focus:ring-slate-500 transition-colors">
                                </div>
                                @error('new_password') <span class="text-xs text-red-500 mt-1">{{ $message }}</span> @enderror
                            </div>

                            <div class="pt-2">
                                <button type="submit" 
                                        class="w-full px-4 py-2.5 bg-slate-800 text-white font-medium rounded-xl hover:bg-slate-900 focus:ring-4 focus:ring-slate-500/30 transition-all shadow-lg shadow-slate-500/20 flex items-center justify-center gap-2">
                                    <i class="bi bi-shield-check"></i>
                                    Update Password
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
