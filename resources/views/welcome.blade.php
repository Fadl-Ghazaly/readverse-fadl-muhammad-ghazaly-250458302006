<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Readverse - Jelajahi dunia cerita tanpa batas. Platform membaca & menulis novel digital masa depan.">
    <title>{{ config('app.name', 'Readverse') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Alpine.js -->
    <script src="//unpkg.com/alpinejs" defer></script>

    <!-- Scripts & Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Outfit', sans-serif; }
        
        /* Modern Scrollbar */
        ::-webkit-scrollbar { width: 8px; }
        ::-webkit-scrollbar-track { background: #f1f5f9; }
        ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 4px; }
        ::-webkit-scrollbar-thumb:hover { background: #94a3b8; }

        /* Blob Animation */
        .blob {
            position: absolute;
            filter: blur(40px);
            z-index: -1;
            opacity: 0.4;
            animation: move 10s infinite alternate;
        }
        @keyframes move {
            from { transform: translate(0, 0) scale(1); }
            to { transform: translate(20px, -20px) scale(1.1); }
        }
        .glass-nav {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }
    </style>
</head>
<body class="antialiased text-slate-800 bg-slate-50 overflow-x-hidden" x-data="{ scrolled: false, mobileMenu: false }" @scroll.window="scrolled = (window.pageYOffset > 20)">

    <!-- Background Blobs -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none">
        <div class="blob bg-purple-300 w-96 h-96 rounded-full top-0 left-0 -translate-x-1/2 -translate-y-1/2"></div>
        <div class="blob bg-blue-300 w-96 h-96 rounded-full bottom-0 right-0 translate-x-1/2 translate-y-1/2 animation-delay-2000"></div>
        <div class="blob bg-indigo-300 w-80 h-80 rounded-full top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 opacity-30"></div>
    </div>

    <!-- Navigation -->
    <nav :class="{ 'glass-nav shadow-sm': scrolled, 'bg-transparent': !scrolled }" class="fixed w-full z-50 transition-all duration-300 top-0">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-20 items-center">
                <!-- Logo -->
                <div class="flex-shrink-0 flex items-center gap-3">
                    <img src="{{ asset('NiceAdmin/assets/img/Logo1.png') }}" alt="Readverse" class="h-10 w-auto drop-shadow-md hover:scale-105 transition-transform duration-300">
                    <span class="font-bold text-2xl tracking-tight text-slate-900">Readverse</span>
                </div>

                <!-- Desktop Menu -->
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#features" class="text-slate-600 hover:text-indigo-600 font-medium transition-colors">Fitur</a>
                    <a href="#about" class="text-slate-600 hover:text-indigo-600 font-medium transition-colors">Tentang</a>
                    
                    @if (Route::has('login'))
                        <div class="flex items-center gap-4 ml-4">
                            @auth
                                <a href="{{ url('/dashboard') }}" class="font-semibold text-slate-600 hover:text-indigo-600 transition-colors">Dashboard</a>
                            @else
                                <a href="{{ route('login') }}" class="text-slate-600 hover:text-indigo-600 font-medium transition-colors">Log in</a>

                                @if (Route::has('register'))
                                    <a href="{{ route('register') }}" class="px-5 py-2.5 bg-indigo-600 text-white font-medium rounded-full hover:bg-indigo-700 shadow-lg shadow-indigo-500/30 hover:shadow-indigo-500/50 transition-all duration-300 transform hover:-translate-y-0.5">
                                        Mulai Menulis
                                    </a>
                                @endif
                            @endauth
                        </div>
                    @endif
                </div>

                <!-- Mobile Menu Button -->
                <div class="md:hidden flex items-center">
                    <button @click="mobileMenu = !mobileMenu" class="text-slate-600 hover:text-indigo-600 focus:outline-none p-2">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" x-show="!mobileMenu"/>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" x-show="mobileMenu" x-cloak/>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div x-show="mobileMenu" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-2"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-2"
             class="md:hidden bg-white/95 backdrop-blur-md border-b border-slate-100 absolute w-full shadow-lg" x-cloak>
            <div class="px-4 pt-2 pb-6 space-y-2">
                <a href="#features" class="block px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:text-indigo-600 hover:bg-indigo-50">Fitur</a>
                <a href="#about" class="block px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:text-indigo-600 hover:bg-indigo-50">Tentang</a>
                @auth
                    <a href="{{ url('/dashboard') }}" class="block px-3 py-2 rounded-md text-base font-medium text-indigo-600 bg-indigo-50">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="block px-3 py-2 rounded-md text-base font-medium text-slate-700 hover:text-indigo-600 hover:bg-indigo-50">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="block px-3 py-2 mt-4 text-center rounded-full text-base font-medium bg-indigo-600 text-white hover:bg-indigo-700 shadow-md">
                            Mulai Sekarang
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative pt-32 pb-20 lg:pt-48 lg:pb-32 overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <h1 class="text-5xl md:text-7xl font-extrabold text-slate-900 tracking-tight mb-6" 
                x-data="{ show: false }" x-init="setTimeout(() => show = true, 100)"
                :class="{ 'opacity-0 translate-y-4': !show, 'opacity-100 translate-y-0': show }"
                class="transition-all duration-700 ease-out">
                Dunia Cerita <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-purple-600">Tanpa Batas</span>
            </h1>
            <p class="mt-4 max-w-2xl mx-auto text-xl text-slate-600 mb-10"
               x-data="{ show: false }" x-init="setTimeout(() => show = true, 300)"
               :class="{ 'opacity-0 translate-y-4': !show, 'opacity-100 translate-y-0': show }"
               class="transition-all duration-700 ease-out delay-200">
                Platform membaca dan menulis novel digital yang menghubungkan imajinasi penulis dengan hati pembaca. Mulai petualanganmu hari ini.
            </p>
            <div class="flex justify-center gap-4"
                 x-data="{ show: false }" x-init="setTimeout(() => show = true, 500)"
                 :class="{ 'opacity-0 translate-y-4': !show, 'opacity-100 translate-y-0': show }"
                 class="transition-all duration-700 ease-out delay-400">
                @if (Route::has('register'))
                    <a href="{{ route('register') }}" class="px-8 py-4 bg-indigo-600 text-white font-bold rounded-full hover:bg-indigo-700 shadow-xl shadow-indigo-500/30 hover:shadow-indigo-500/50 transition-all duration-300 transform hover:-translate-y-1 flex items-center gap-2">
                        <span>Mulai Membaca</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                @endif
                <a href="#features" class="px-8 py-4 bg-white text-slate-700 font-bold rounded-full border border-slate-200 hover:border-indigo-300 hover:bg-indigo-50 transition-all duration-300 transform hover:-translate-y-1">
                    Pelajari Lebih Lanjut
                </a>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div id="features" class="py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16">
                <h2 class="text-base text-indigo-600 font-semibold tracking-wide uppercase">Fitur Unggulan</h2>
                <p class="mt-2 text-3xl leading-8 font-extrabold tracking-tight text-slate-900 sm:text-4xl">
                    Semua yang Anda Butuhkan
                </p>
                <p class="mt-4 max-w-2xl text-xl text-slate-500 mx-auto">
                    Readverse dirancang untuk memberikan pengalaman terbaik bagi penulis dan pembaca.
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <!-- Feature 1 -->
                <div class="group relative p-8 bg-slate-50 rounded-3xl hover:bg-white border border-slate-100 hover:border-indigo-100 shadow-sm hover:shadow-xl transition-all duration-300">
                    <div class="absolute top-0 left-0 -mt-6 ml-6 w-12 h-12 bg-gradient-to-br from-indigo-500 to-purple-600 rounded-2xl flex items-center justify-center shadow-lg transform group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                    <h3 class="mt-4 text-xl font-bold text-slate-900">Perpustakaan Luas</h3>
                    <p class="mt-2 text-slate-600 leading-relaxed">
                        Akses ribuan novel dari berbagai genre. Temukan cerita favoritmu dan simpan di rak buku pribadi.
                    </p>
                </div>

                <!-- Feature 2 -->
                <div class="group relative p-8 bg-slate-50 rounded-3xl hover:bg-white border border-slate-100 hover:border-indigo-100 shadow-sm hover:shadow-xl transition-all duration-300">
                    <div class="absolute top-0 left-0 -mt-6 ml-6 w-12 h-12 bg-gradient-to-br from-pink-500 to-rose-500 rounded-2xl flex items-center justify-center shadow-lg transform group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </div>
                    <h3 class="mt-4 text-xl font-bold text-slate-900">Studio Penulis</h3>
                    <p class="mt-2 text-slate-600 leading-relaxed">
                        Tools menulis yang powerful dan intuitif. Publikasikan karyamu dan bangun audiens setiamu sendiri.
                    </p>
                </div>

                <!-- Feature 3 -->
                <div class="group relative p-8 bg-slate-50 rounded-3xl hover:bg-white border border-slate-100 hover:border-indigo-100 shadow-sm hover:shadow-xl transition-all duration-300">
                    <div class="absolute top-0 left-0 -mt-6 ml-6 w-12 h-12 bg-gradient-to-br from-emerald-500 to-teal-500 rounded-2xl flex items-center justify-center shadow-lg transform group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                    </div>
                    <h3 class="mt-4 text-xl font-bold text-slate-900">Komunitas Aktif</h3>
                    <p class="mt-2 text-slate-600 leading-relaxed">
                        Berinteraksi dengan penulis dan pembaca lain. Berikan komentar, like, dan dukungan untuk karya terbaik.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="relative py-20 overflow-hidden">
        <div class="absolute inset-0 bg-indigo-900">
            <div class="absolute inset-0 bg-gradient-to-r from-indigo-900 to-purple-900 opacity-90"></div>
            <!-- Decorative circles -->
            <div class="absolute top-0 left-0 -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-indigo-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>
            <div class="absolute bottom-0 right-0 translate-x-1/2 translate-y-1/2 w-96 h-96 bg-purple-500 rounded-full mix-blend-multiply filter blur-3xl opacity-20"></div>
        </div>
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-extrabold text-white sm:text-4xl mb-6">
                Siap Memulai Petualangan Barumu?
            </h2>
            <p class="text-xl text-indigo-100 mb-10 max-w-2xl mx-auto">
                Bergabunglah dengan ribuan pembaca dan penulis lainnya di Readverse. Gratis dan mudah.
            </p>
            <a href="{{ route('register') }}" class="inline-block px-8 py-4 bg-white text-indigo-900 font-bold rounded-full hover:bg-indigo-50 shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                Daftar Sekarang Gratis
            </a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-slate-950 text-slate-400 py-16 border-t border-slate-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Grid Layout: Mobile (2 cols), Tablet (2 cols - balanced), Desktop (4 cols) -->
            <div class="grid grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12 mb-12">
                
                <!-- Brand Section: Full width on mobile/tablet? No, keep logic simple. -->
                <!-- Mobile: col-span-2 (Full width) -->
                <!-- Tablet: col-span-1 (Half width) -> With 2 cols grid, this fits nicely. -->
                <!-- Desktop: col-span-1 -->
                <div class="col-span-2 md:col-span-1 lg:col-span-1">
                    <div class="flex items-center gap-3 mb-6">
                        <img src="{{ asset('NiceAdmin/assets/img/Logo1.png') }}" alt="Readverse" class="h-9 w-auto grayscale opacity-80 hover:grayscale-0 hover:opacity-100 transition-all duration-300">
                        <span class="font-bold text-xl text-slate-200">Readverse</span>
                    </div>
                    <p class="text-sm leading-relaxed text-slate-500 mb-6 max-w-sm">
                        Platform novel digital masa depan yang menghubungkan imajinasi penulis dengan hati pembaca.
                    </p>
                    <div class="flex gap-4">
                        <a href="#" class="text-slate-500 hover:text-indigo-400 transition-colors"><span class="sr-only">Twitter</span><svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path></svg></a>
                        <a href="#" class="text-slate-500 hover:text-indigo-400 transition-colors"><span class="sr-only">Instagram</span><svg class="h-5 w-5" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.067.06 1.407.06 4.123v.08c0 2.643-.012 2.987-.06 4.043-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.067.048-1.407.06-4.123.06h-.08c-2.643 0-2.987-.012-4.043-.06-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.047-1.024-.06-1.379-.06-3.808v-.63c0-2.43.013-2.784.06-3.808.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772 4.902 4.902 0 011.772-1.153c.636-.247 1.363-.416 2.427-.465C9.673 2.013 10.03 2 12.315 2zm-2.008 2H12.316c2.128 0 2.382.016 3.238.056 1.698.082 2.29.569 2.4.618.349.155.518.339.69.511.171.172.355.34.51.69.05.109.536.701.618 2.399.04.856.056 1.11.056 3.239v.08c0 2.129-.016 2.382-.056 3.238-.083 1.698-.569 2.29-.618 2.4-.155.349-.339.518-.511.69-.172-.171.34-.355.69-.51.109.05-.701-.536 2.399-.618.856-.04 1.11-.056 3.239-.056zM12.315 7.218a4.782 4.782 0 110 9.565 4.782 4.782 0 010-9.565zm0 1.8a2.982 2.982 0 100 5.964 2.982 2.982 0 000-5.964zM16.924 5.976a1.2 1.2 0 11-2.4 0 1.2 1.2 0 012.4 0z" clip-rule="evenodd" /></svg></a>
                    </div>
                </div>

                <!-- Links Sections -->
                <div>
                    <h4 class="text-slate-200 font-bold mb-6">Platform</h4>
                    <ul class="space-y-4 text-sm font-medium">
                        <li><a href="#" class="hover:text-indigo-400 transition-colors">Trending</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition-colors">Terbaru</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition-colors">Kategori</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-slate-200 font-bold mb-6">Komunitas</h4>
                    <ul class="space-y-4 text-sm font-medium">
                        <li><a href="#" class="hover:text-indigo-400 transition-colors">Pedoman Penulis</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition-colors">Forum Diskusi</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition-colors">Bantuan</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-slate-200 font-bold mb-6">Legal</h4>
                    <ul class="space-y-4 text-sm font-medium">
                        <li><a href="#" class="hover:text-indigo-400 transition-colors">Privacy Policy</a></li>
                        <li><a href="#" class="hover:text-indigo-400 transition-colors">Terms of Service</a></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-slate-900 pt-8 flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-slate-600">
                <div>
                    &copy; {{ date('Y') }} Readverse. All rights reserved.
                    <a href="#" class="hover:text-white transition-colors">Privacy</a>
                    <a href="#" class="hover:text-white transition-colors">Terms</a>
                    <a href="#" class="hover:text-white transition-colors">Cookies</a>
                </div>
            </div>
        </div>
    </footer>

</body>
</html>