@extends('layouts.admin-auth')
@section('title', 'Admin Login')

@section('content')
<div class="card card-outline card-primary">
  <div class="card-header text-center">
    <p class="login-box-msg fw-semibold fs-5 mb-0">
      <i class="bi bi-shield-lock me-1"></i> Admin Sign In
    </p>
    <small class="text-muted">Enter your admin credentials to continue</small>
  </div>

  <div class="card-body">
    <form method="POST" action="{{ route('adminlogin') }}">
      @csrf

      {{-- Email --}}
      <div class="input-group mb-3">
        <input type="email" name="email" value="{{ old('email') }}"
               class="form-control @error('email') is-invalid @enderror"
               placeholder="Email address" required autofocus>
        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
        @error('email')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      {{-- Password --}}
      <div class="input-group mb-3">
        <input type="password" name="password" id="adminPassword"
               class="form-control @error('password') is-invalid @enderror"
               placeholder="Password" required>
        <span class="input-group-text" style="cursor:pointer"
              onclick="togglePass()">
          <i class="bi bi-eye" id="eyeIcon"></i>
        </span>
        @error('password')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      {{-- Remember me --}}
      <div class="row mb-3">
        <div class="col-8">
          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="remember">
            <label class="form-check-label" for="remember">Remember me</label>
          </div>
        </div>
        <div class="col-4 text-end">
          <a href="{{ route('adminpassword') }}" class="text-decoration-none small">Forgot password?</a>
        </div>
      </div>

      {{-- Submit --}}
      <div class="d-grid">
        <button type="submit" class="btn btn-primary">
          <i class="bi bi-box-arrow-in-right me-1"></i> Sign In
        </button>
      </div>
    </form>
  </div>
</div>
@endsection

@push('scripts')
<script>
  function togglePass() {
    const inp = document.getElementById('adminPassword');
    const icon = document.getElementById('eyeIcon');
    if (inp.type === 'password') {
      inp.type = 'text';
      icon.classList.replace('bi-eye', 'bi-eye-slash');
    } else {
      inp.type = 'password';
      icon.classList.replace('bi-eye-slash', 'bi-eye');
    }
  }
</script>
@endpush
