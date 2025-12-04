<div class="p-6 lg:p-8">
    
    {{-- Page Title --}}
    <div class="mb-8">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-2xl font-bold text-slate-800">Profil Saya</h1>
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
                                <span class="ml-1 text-sm font-medium text-slate-400 md:ml-2">Profil</span>
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
        <div class="max-w-4xl">

            {{-- Success Alert --}}
            @if (session()->has('message'))
                <div class="mb-6 flex items-center p-4 bg-green-50 border border-green-200 rounded-xl text-green-800" role="alert">
                    <i class="bi bi-check-circle-fill text-green-500 text-xl mr-3"></i>
                    <span>{{ session('message') }}</span>
                    <button type="button" class="ml-auto text-green-500 hover:text-green-700" onclick="this.parentElement.remove()">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
            @endif

            {{-- Error Alert --}}
            @if (session()->has('error'))
                <div class="mb-6 flex items-center p-4 bg-red-50 border border-red-200 rounded-xl text-red-800" role="alert">
                    <i class="bi bi-exclamation-circle-fill text-red-500 text-xl mr-3"></i>
                    <span>{{ session('error') }}</span>
                    <button type="button" class="ml-auto text-red-500 hover:text-red-700" onclick="this.parentElement.remove()">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
            @endif

            {{-- Profile Information Card --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden mb-6">
                
                {{-- Header --}}
                <div class="p-6 bg-gradient-to-r from-teal-600 to-cyan-600 border-b border-teal-100">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-white/20 backdrop-blur-sm rounded-lg">
                            <i class="bi bi-person-circle text-white text-2xl"></i>
                        </div>
                        <div>
                            <h5 class="text-xl font-bold text-white">Informasi Profil</h5>
                            <p class="text-sm text-teal-100 mt-0.5">Kelola data profil Anda</p>
                        </div>
                    </div>
                </div>

                {{-- Form --}}
                <form wire:submit.prevent="updateProfile" class="p-6">
                    
                    {{-- Profile Photo Section --}}
                    <div class="flex flex-col items-center mb-8 pb-6 border-b border-slate-200">
                        <div class="relative group">
                            @if (auth()->user()->profile_photo)
                                <img src="{{ asset('storage/'.auth()->user()->profile_photo) }}" 
                                     class="w-32 h-32 rounded-full object-cover ring-4 ring-teal-100 shadow-lg"
                                     alt="Profile Photo">
                            @else
                                <div class="w-32 h-32 rounded-full bg-gradient-to-br from-teal-500 to-cyan-600 flex items-center justify-center text-white text-4xl font-bold ring-4 ring-teal-100 shadow-lg">
                                    {{ substr(auth()->user()->name, 0, 1) }}
                                </div>
                            @endif
                            <div class="absolute bottom-0 right-0 w-10 h-10 bg-teal-600 rounded-full flex items-center justify-center border-4 border-white shadow-lg group-hover:bg-teal-700 transition-colors cursor-pointer">
                                <i class="bi bi-camera-fill text-white text-sm"></i>
                            </div>
                        </div>
                        <div class="mt-4 w-full max-w-md">
                            <label class="block text-sm font-semibold text-slate-700 mb-2 text-center">
                                <i class="bi bi-image mr-1.5 text-teal-600"></i>Upload Foto Profil
                            </label>
                            <input type="file" 
                                   wire:model="profile_photo"
                                   accept="image/*"
                                   class="w-full px-4 py-2.5 border border-slate-200 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-teal-50 file:text-teal-700 hover:file:bg-teal-100">
                            <p class="mt-2 text-xs text-center text-slate-500">
                                <i class="bi bi-info-circle mr-1"></i>
                                Format: JPG, PNG. Max: 2MB
                            </p>
                        </div>
                    </div>

                    {{-- Name & Email Fields --}}
                    <div class="space-y-6">
                        
                        {{-- Name --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                <i class="bi bi-person-fill mr-1.5 text-teal-600"></i>Nama Lengkap
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="text" 
                                   wire:model="name"
                                   class="w-full px-4 py-3 border border-slate-200 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all placeholder-slate-400"
                                   placeholder="Masukkan nama lengkap...">
                            @error('name')
                                <p class="mt-1.5 text-sm text-red-600 flex items-center gap-1">
                                    <i class="bi bi-exclamation-circle"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                <i class="bi bi-envelope-fill mr-1.5 text-teal-600"></i>Email
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="email" 
                                   wire:model="email"
                                   class="w-full px-4 py-3 border border-slate-200 rounded-lg focus:ring-2 focus:ring-teal-500 focus:border-transparent transition-all placeholder-slate-400"
                                   placeholder="email@example.com">
                            @error('email')
                                <p class="mt-1.5 text-sm text-red-600 flex items-center gap-1">
                                    <i class="bi bi-exclamation-circle"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                    </div>

                    {{-- Save Button --}}
                    <div class="mt-8 pt-6 border-t border-slate-200">
                        <button type="submit" 
                                class="w-full px-6 py-3 bg-gradient-to-r from-teal-600 to-cyan-600 text-white font-medium rounded-lg hover:from-teal-700 hover:to-cyan-700 shadow-lg shadow-teal-500/30 hover:shadow-teal-500/50 transition-all duration-300 flex items-center justify-center gap-2">
                            <i class="bi bi-save-fill"></i>
                            <span>Simpan Perubahan Profil</span>
                        </button>
                    </div>

                </form>

            </div>

            {{-- Change Password Card --}}
            <div class="bg-white rounded-2xl shadow-sm border border-slate-100 overflow-hidden">
                
                {{-- Header --}}
                <div class="p-6 bg-gradient-to-r from-slate-700 to-slate-900 border-b border-slate-600">
                    <div class="flex items-center gap-3">
                        <div class="p-2 bg-white/20 backdrop-blur-sm rounded-lg">
                            <i class="bi bi-shield-lock-fill text-white text-2xl"></i>
                        </div>
                        <div>
                            <h5 class="text-xl font-bold text-white">Ganti Password</h5>
                            <p class="text-sm text-slate-300 mt-0.5">Update password untuk keamanan akun</p>
                        </div>
                    </div>
                </div>

                {{-- Form --}}
                <form wire:submit.prevent="updatePassword" class="p-6">
                    
                    <div class="space-y-6">
                        
                        {{-- Current Password --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                <i class="bi bi-lock-fill mr-1.5 text-slate-600"></i>Password Saat Ini
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="password" 
                                   wire:model="password"
                                   class="w-full px-4 py-3 border border-slate-200 rounded-lg focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all placeholder-slate-400"
                                   placeholder="Masukkan password lama...">
                            @error('password')
                                <p class="mt-1.5 text-sm text-red-600 flex items-center gap-1">
                                    <i class="bi bi-exclamation-circle"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        {{-- New Password --}}
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                <i class="bi bi-key-fill mr-1.5 text-slate-600"></i>Password Baru
                                <span class="text-red-500">*</span>
                            </label>
                            <input type="password" 
                                   wire:model="new_password"
                                   class="w-full px-4 py-3 border border-slate-200 rounded-lg focus:ring-2 focus:ring-slate-500 focus:border-transparent transition-all placeholder-slate-400"
                                   placeholder="Masukkan password baru...">
                            @error('new_password')
                                <p class="mt-1.5 text-sm text-red-600 flex items-center gap-1">
                                    <i class="bi bi-exclamation-circle"></i>{{ $message }}
                                </p>
                            @enderror
                            <p class="mt-2 text-xs text-slate-500">
                                <i class="bi bi-info-circle mr-1"></i>
                                Password minimal 8 karakter
                            </p>
                        </div>

                    </div>

                    {{-- Update Button --}}
                    <div class="mt-8 pt-6 border-t border-slate-200">
                        <button type="submit" 
                                class="w-full px-6 py-3 bg-gradient-to-r from-slate-700 to-slate-900 text-white font-medium rounded-lg hover:from-slate-800 hover:to-black shadow-lg shadow-slate-500/30 hover:shadow-slate-500/50 transition-all duration-300 flex items-center justify-center gap-2">
                            <i class="bi bi-shield-check"></i>
                            <span>Update Password</span>
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </section>

</div>