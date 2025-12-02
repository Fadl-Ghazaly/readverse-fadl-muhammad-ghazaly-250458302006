<div>

    <div class="pagetitle">
        <h1>Laporan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Laporan</li>
            </ol>
        </nav>
    </div>

    <a href="{{ route('dashboard') }}" class="btn btn-primary mb-3">
        <i class="bi bi-chevron-left"></i>
    </a>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                @forelse($reports as $report)
                    <div class="card mb-3">
                        <div class="card-body">

                            <strong>Pelapor:</strong> {{ $report->user->name }} <br>
                            <strong>Tipe Target:</strong> {{ $report->target_type_name }} <br>
                            <strong>Target:</strong> {{ $report->target_title }} <br>
                            <strong>Kategori:</strong> {{ $report->kategori }} <br>

                            <strong>Status:</strong>
                            <span class="badge bg-warning text-dark">{{ $report->status }}</span>

                            <p class="mt-2">{{ $report->deskripsi }}</p>

                            <a href="{{ route('admin.report.detail', $report->id) }}"
                               class="btn btn-primary">
                                Detail
                            </a>

                        </div>
                    </div>
                @empty

                    <div class="card">
                        <div class="card-body text-center text-muted">
                            Belum ada laporan.
                        </div>
                    </div>

                @endforelse

            </div>
        </div>
    </section>

</div>
