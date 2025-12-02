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
                  <h5 class="card-title text-center pb-0 fs-4">Lupa Password?</h5>
                  <p class="text-center small">
                    Masukkan email Anda. Kami akan mengirim link untuk reset password.
                  </p>
                </div>

                <!-- Session Status -->
                @if (session('status'))
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('status') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif

                <form class="row g-3" method="POST" action="{{ route('password.email') }}">
                  @csrf

                  <div class="col-12">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                      id="email" value="{{ old('email') }}" required autofocus>
                    @error('email')
                      <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                  </div>

                  <div class="col-12">
                    <button class="btn btn-primary w-100" type="submit">
                      Kirim Link Reset Password
                    </button>
                  </div>

                 <div class="col-12 text-center mt-3">
    <a href="{{ route('login') }}" class="text-primary text-decoration-none small">
        <i class="bi bi-arrow-left me-1"></i> Kembali ke halaman login
    </a>
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