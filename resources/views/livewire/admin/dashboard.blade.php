<div>

    {{-- Page Title --}}
    <div class="pagetitle">
        <h1>Dashboard</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
            </ol>
        </nav>
    </div>

    <section class="section dashboard">

        {{-- Statistik Cards --}}
        <div class="row">

            {{-- Total Novel --}}
            <div class="col-xxl-3 col-md-6">
                <div class="card info-card sales-card">
                    <div class="card-body">
                        <h5 class="card-title">Total Novel</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-book"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $totalNovels }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Total Episode --}}
            <div class="col-xxl-3 col-md-6">
                <div class="card info-card revenue-card">
                    <div class="card-body">
                        <h5 class="card-title">Total Episode</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-collection-play"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $totalEpisodes }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Total Genre --}}
            <div class="col-xxl-3 col-md-6">
                <div class="card info-card customers-card">
                    <div class="card-body">
                        <h5 class="card-title">Total Genre</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-tags"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $totalGenres }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Total User --}}
            <div class="col-xxl-3 col-md-6">
                <div class="card info-card customers-card">
                    <div class="card-body">
                        <h5 class="card-title">Total Pengguna</h5>
                        <div class="d-flex align-items-center">
                            <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                <i class="bi bi-people"></i>
                            </div>
                            <div class="ps-3">
                                <h6>{{ $totalUsers }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        {{-- Statistik Chart --}}
        <div class="row mt-4">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Grafik Statistik</h5>
                        <canvas id="statsChart" height="120"></canvas>
                    </div>
                </div>
            </div>
        </div>

    </section>
</div>

{{-- Chart.js --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {
    new Chart(document.getElementById('statsChart'), {
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
                borderWidth: 2,
                backgroundColor: [
                    'rgba(65, 84, 241, .7)',
                    'rgba(46, 202, 106, .7)',
                    'rgba(255, 119, 29, .7)',
                    'rgba(231, 74, 59, .7)',
                ]
            }]
        },
        options: {
            responsive: true,
            scales: { y: { beginAtZero: true } }
        }
    });
});
</script>
