<div>
<div class="pagetitle">
  <h1>Profil Saya</h1>
  <nav>
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
      <li class="breadcrumb-item active">Profil</li>
    </ol>
  </nav>
</div>

<a href="{{ route('dashboard') }}" class="btn btn-primary mb-3">
  <i class="bi bi-chevron-left"></i>
</a>

<section class="section">
  <div class="row">
    <div class="col-lg-8">
      @if (session()->has('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
          {{ session('message') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
      @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          {{ session('error') }}
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif

      <div class="card">
        <div class="card-body">
          <h5 class="card-title">Informasi Profil</h5>
          <form wire:submit.prevent="updateProfile">
            <div class="text-center mb-3">
              @if (auth()->user()->profile_photo)
                <img src="{{ asset('storage/'.auth()->user()->profile_photo) }}" class="rounded-circle" width="120">
              @else
                <img src="{{ asset('default-profile.png') }}" class="rounded-circle" width="120">
              @endif
            </div>
            <div class="mb-3">
              <label for="profile_photo" class="form-label">Foto Profil</label>
              <input type="file" wire:model="profile_photo" class="form-control">
            </div>
            <div class="mb-3">
              <label for="name" class="form-label">Nama</label>
              <input type="text" wire:model="name" class="form-control">
              @error('name') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="email" wire:model="email" class="form-control">
              @error('email') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
            <button type="submit" class="btn btn-primary">Simpan Profil</button>
          </form>
        </div>
      </div>

      <div class="card mt-4">
        <div class="card-body">
          <h5 class="card-title">Ganti Password</h5>
          <form wire:submit.prevent="updatePassword">
            <div class="mb-3">
              <label for="password" class="form-label">Password Lama</label>
              <input type="password" wire:model="password" class="form-control">
              @error('password') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
              <label for="new_password" class="form-label">Password Baru</label>
              <input type="password" wire:model="new_password" class="form-control">
              @error('new_password') <div class="text-danger">{{ $message }}</div> @enderror
            </div>
            <button type="submit" class="btn btn-primary">Ubah Password</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</section>