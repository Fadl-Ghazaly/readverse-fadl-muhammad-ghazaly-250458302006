<div>

    <div class="pagetitle">
        <h1>Kelola Komentar</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                <li class="breadcrumb-item active">Kelola Komentar</li>
            </ol>
        </nav>
    </div>

    <a href="{{ route('dashboard') }}" class="btn btn-primary mb-3">
        <i class="bi bi-chevron-left"></i>
    </a>

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <div class="card-body">

                        <h5 class="card-title">Daftar Novel dengan Komentar</h5>

                        @if ($novels->count())
                            <div class="table-responsive">
                                <table class="table datatable">
                                    <thead>
                                        <tr>
                                            <th>Novel</th>
                                            <th>Total Komentar</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($novels as $novel)
                                            <tr>
                                                <td>{{ $novel->title }}</td>
                                                <td>
                                                    <span class="badge bg-primary">
                                                        {{ $novel->comments_count }} Komentar
                                                    </span>
                                                </td>
                                                <td>
                                                    <a href="{{ route('admin.comment.detail', $novel->id) }}"
                                                       class="btn btn-primary btn-sm">
                                                        <i class="bi bi-chat-square-text"></i> Lihat Detail
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>

                                </table>
                            </div>
                        @else
                            <p class="text-muted">Belum ada komentar dari pengguna.</p>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </section>

</div>
