<div>

    <div class="pagetitle">
        <h1>Detail Laporan</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item"><a href="{{ route('admin.reports') }}">Laporan</a></li>
                <li class="breadcrumb-item active">Detail</li>
            </ol>
        </nav>
    </div>

    <a href="{{ route('admin.reports') }}" class="btn btn-primary mb-3">
        <i class="bi bi-chevron-left"></i>
    </a>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">

                        <strong>Pelapor:</strong> {{ $report->user->name }} <br>
                        <strong>Tipe Target:</strong> {{ $report->target_type_name }} <br>
                        <strong>Target:</strong> {{ $report->target_title }} <br>
                        <strong>Kategori:</strong> {{ $report->kategori }} <br>
                        <strong>Status:</strong> {{ $report->status }} <br>

                        <p class="mt-3">{{ $report->deskripsi }}</p>

                        <a href="{{ route('admin.reports') }}" class="btn btn-secondary">
                            Kembali
                        </a>

                    </div>
                </div>

            </div>
        </div>
    </section>

</div>
