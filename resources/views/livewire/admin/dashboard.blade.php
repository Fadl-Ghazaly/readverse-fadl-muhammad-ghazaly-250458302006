<div>
    <div class="p-6 lg:p-8">
        
        {{-- Page Title --}}
        <div class="mb-8">
            <h1 class="text-2xl font-bold text-slate-800">Dashboard</h1>
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
                            <span class="ml-1 text-sm font-medium text-slate-400 md:ml-2">Dashboard</span>
                        </div>
                    </li>
                </ol>
            </nav>
        </div>

        <section>
            {{-- Statistik Cards --}}
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">

                {{-- Total Novel --}}
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:shadow-md transition-shadow duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <h5 class="text-slate-500 text-sm font-medium uppercase tracking-wide">Total Novel</h5>
                        <div class="p-2 bg-indigo-50 rounded-lg text-indigo-600">
                            <i class="bi bi-book text-xl"></i>
                        </div>
                    </div>
                    <div class="flex items-baseline">
                        <h2 class="text-3xl font-bold text-slate-800">{{ $totalNovels }}</h2>
                        <span class="ml-2 text-sm text-green-500 font-medium flex items-center">
                            <i class="bi bi-arrow-up-short"></i> +12%
                        </span>
                    </div>
                </div>

                {{-- Total Episode --}}
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:shadow-md transition-shadow duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <h5 class="text-slate-500 text-sm font-medium uppercase tracking-wide">Total Episode</h5>
                        <div class="p-2 bg-green-50 rounded-lg text-green-600">
                            <i class="bi bi-collection-play text-xl"></i>
                        </div>
                    </div>
                    <div class="flex items-baseline">
                        <h2 class="text-3xl font-bold text-slate-800">{{ $totalEpisodes }}</h2>
                        <span class="ml-2 text-sm text-green-500 font-medium flex items-center">
                            <i class="bi bi-arrow-up-short"></i> +8%
                        </span>
                    </div>
                </div>

                {{-- Total Genre --}}
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:shadow-md transition-shadow duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <h5 class="text-slate-500 text-sm font-medium uppercase tracking-wide">Total Genre</h5>
                        <div class="p-2 bg-orange-50 rounded-lg text-orange-600">
                            <i class="bi bi-tags text-xl"></i>
                        </div>
                    </div>
                    <div class="flex items-baseline">
                        <h2 class="text-3xl font-bold text-slate-800">{{ $totalGenres }}</h2>
                    </div>
                </div>

                {{-- Total User --}}
                <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 hover:shadow-md transition-shadow duration-300">
                    <div class="flex items-center justify-between mb-4">
                        <h5 class="text-slate-500 text-sm font-medium uppercase tracking-wide">Total Pengguna</h5>
                        <div class="p-2 bg-red-50 rounded-lg text-red-600">
                            <i class="bi bi-people text-xl"></i>
                        </div>
                    </div>
                    <div class="flex items-baseline">
                        <h2 class="text-3xl font-bold text-slate-800">{{ $totalUsers }}</h2>
                        <span class="ml-2 text-sm text-green-500 font-medium flex items-center">
                            <i class="bi bi-arrow-up-short"></i> +5%
                        </span>
                    </div>
                </div>

            </div>

            {{-- Statistik Chart --}}
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100">
                <h5 class="text-lg font-bold text-slate-800 mb-6">Grafik Statistik</h5>
                <div class="relative h-80 w-full">
                    <canvas id="statsChart"></canvas>
                </div>
            </div>

        </section>
    </div>
</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js" defer></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    const ctx = document.getElementById('statsChart').getContext('2d');
    
    // Gradient for Novels
    const gradientNovels = ctx.createLinearGradient(0, 0, 0, 400);
    gradientNovels.addColorStop(0, 'rgba(79, 70, 229, 0.8)'); // Indigo 600
    gradientNovels.addColorStop(1, 'rgba(79, 70, 229, 0.2)');

    // Gradient for Episodes
    const gradientEpisodes = ctx.createLinearGradient(0, 0, 0, 400);
    gradientEpisodes.addColorStop(0, 'rgba(16, 185, 129, 0.8)'); // Emerald 500
    gradientEpisodes.addColorStop(1, 'rgba(16, 185, 129, 0.2)');

    // Gradient for Genres
    const gradientGenres = ctx.createLinearGradient(0, 0, 0, 400);
    gradientGenres.addColorStop(0, 'rgba(249, 115, 22, 0.8)'); // Orange 500
    gradientGenres.addColorStop(1, 'rgba(249, 115, 22, 0.2)');

    // Gradient for Users
    const gradientUsers = ctx.createLinearGradient(0, 0, 0, 400);
    gradientUsers.addColorStop(0, 'rgba(239, 68, 68, 0.8)'); // Red 500
    gradientUsers.addColorStop(1, 'rgba(239, 68, 68, 0.2)');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Novel', 'Episode', 'Genre', 'User'],
            datasets: [{
                label: 'Jumlah Data',
                data: [
                    {{ $chartData['novels'] }},
                    {{ $chartData['episodes'] }},
                    {{ $chartData['genres'] }},
                    {{ $chartData['users'] }}
                ],
                borderWidth: 0,
                borderRadius: 8,
                backgroundColor: [
                    gradientNovels,
                    gradientEpisodes,
                    gradientGenres,
                    gradientUsers,
                ],
                barPercentage: 0.6,
                categoryPercentage: 0.8
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    backgroundColor: 'rgba(15, 23, 42, 0.9)',
                    titleColor: '#f8fafc',
                    bodyColor: '#f8fafc',
                    padding: 12,
                    cornerRadius: 8,
                    displayColors: false,
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: {
                        color: '#f1f5f9',
                        drawBorder: false,
                    },
                    ticks: {
                        font: {
                            family: "'Outfit', sans-serif",
                            size: 12
                        },
                        color: '#64748b'
                    }
                },
                x: {
                    grid: {
                        display: false,
                        drawBorder: false,
                    },
                    ticks: {
                        font: {
                            family: "'Outfit', sans-serif",
                            size: 12,
                            weight: '500'
                        },
                        color: '#64748b'
                    }
                }
            }
        }
    });
});
</script>
