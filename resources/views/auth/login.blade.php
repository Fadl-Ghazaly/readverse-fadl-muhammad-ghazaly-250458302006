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
            </div><!-- End Logo -->

            <div class="card mb-3">
              <div class="card-body">
                <div class="pt-4 pb-2">
                  <h5 class="card-title text-center pb-0 fs-4">Login ke Akun Anda</h5>
                  <p class="text-center small">Masukkan email dan password untuk masuk</p>
                </div>

                @if (session('status'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif

                <form class="row g-3 needs-validation" method="POST" action="{{ route('login') }}" novalidate>
                  @csrf

                  <div class="col-12">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" required>
                    @error('email')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="col-12">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password" required>
                    @error('password')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="col-12">
                    <div class="form-check">
                      <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                      <label class="form-check-label" for="remember">Ingat saya</label>
                    </div>
                  </div>

                  <div class="col-12">
                    <button class="btn btn-primary w-100" type="submit">Login</button>
                  </div>

                  <div class="col-12">
                    <p class="small mb-0">
                      <a href="{{ route('password.request') }}">Lupa password?</a>
                    </p>
                  </div>

                  @if (Route::has('register'))
                    <div class="col-12">
                      <p class="small mb-0">Belum punya akun? <a href="{{ route('register') }}">Daftar</a></p>
                    </div>
                  @endif
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