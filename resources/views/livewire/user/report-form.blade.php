<div>
<div class="card">
  <div class="card-body">
    <h5 class="card-title">Laporkan {{ ucfirst($targetType) }}</h5>

    @if (session()->has('message'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('message') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif

    <form wire:submit.prevent="submit">
      <div class="mb-3">
        <label class="form-label">Kategori Laporan</label>
        <select wire:model="kategori" class="form-select">
          <option value="">-- pilih kategori --</option>
          <option>Pelanggaran Aturan</option>
          <option>Konten Tidak Pantas</option>
          <option>Spam</option>
          <option>Lainnya</option>
        </select>
      </div>

      <div class="mb-3">
        <label class="form-label">Deskripsi</label>
        <textarea wire:model="deskripsi" rows="3" class="form-control"></textarea>
      </div>

      <button type="submit" class="btn btn-danger">Kirim Laporan</button>
    </form>
  </div>
</div>
