@extends('layouts.guest')

@section('content')
<main>
  <div class="container">
    <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">

            <div class="d-flex justify-content-center py-4">
              <a href="{{ route('welcome') }}" class="logo d-flex align-items-center w-auto">
                <img src="{{ asset('NiceAdmin/assets/img/Logo1.png') }}" alt="">
                <span class="d-none d-lg-block">Readverse</span>
              </a>
            </div>

            <div class="card mb-3">
              <div class="card-body">
                <div class="pt-4 pb-2">
                  <h5 class="card-title text-center pb-0 fs-4">Reset Password</h5>
                  <p class="text-center small">
                    Masukkan password baru Anda.
                  </p>
                </div>

               <form class="row g-3" method="POST" action="{{ route('password.store') }}">
  @csrf

  <!-- Hidden Token -->
  <input type="hidden" name="token" value="{{ $request->route('token') }}">

  <div class="col-12">
    <label for="email" class="form-label">Email</label>
    <input type="email" 
           name="email" 
           class="form-control @error('email') is-invalid @enderror"
           value="{{ old('email', $request->email) }}" 
           required 
           autofocus>
    @error('email')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>

  <div class="col-12">
    <label for="password" class="form-label">Password Baru</label>
    <input type="password" 
           name="password" 
           class="form-control @error('password') is-invalid @enderror" 
           required>
    @error('password')
      <div class="invalid-feedback">{{ $message }}</div>
    @enderror
  </div>

  <div class="col-12">
    <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
    <input type="password" 
           name="password_confirmation" 
           class="form-control" 
           required>
  </div>

  <div class="col-12">
    <button class="btn btn-primary w-100" type="submit">
      Simpan Password Baru
    </button>
  </div>
</form>

              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>
</main>
@endsection