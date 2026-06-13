@extends('layouts.admin-auth')
@section('title', 'Reset Password')

@section('content')
<div class="card card-outline card-primary">
  <div class="card-header text-center">
    <p class="login-box-msg fw-semibold fs-5 mb-0">
      <i class="bi bi-lock me-1"></i> Reset Password
    </p>
    <small class="text-muted">Enter your token and choose a new password</small>
  </div>

  <div class="card-body">
    <form method="POST" action="{{ route('restpass') }}">
      @csrf

      {{-- Email --}}
      <div class="input-group mb-3">
        <input type="email" name="email" value="{{ old('email') }}"
               class="form-control @error('email') is-invalid @enderror"
               placeholder="Email address" required>
        <span class="input-group-text"><i class="bi bi-envelope"></i></span>
        @error('email')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      {{-- Token --}}
      <div class="input-group mb-3">
        <input type="number" name="token"
               class="form-control @error('token') is-invalid @enderror"
               placeholder="Reset token (from email)" required>
        <span class="input-group-text"><i class="bi bi-hash"></i></span>
        @error('token')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      {{-- New Password --}}
      <div class="input-group mb-3">
        <input type="password" name="password" id="newPass"
               class="form-control @error('password') is-invalid @enderror"
               placeholder="New password" required>
        <span class="input-group-text" style="cursor:pointer"
              onclick="togglePass('newPass','eye1')">
          <i class="bi bi-eye" id="eye1"></i>
        </span>
        @error('password')
          <div class="invalid-feedback">{{ $message }}</div>
        @enderror
      </div>

      {{-- Confirm Password --}}
      <div class="input-group mb-3">
        <input type="password" name="password_confirmation" id="confPass"
               class="form-control"
               placeholder="Confirm new password" required>
        <span class="input-group-text" style="cursor:pointer"
              onclick="togglePass('confPass','eye2')">
          <i class="bi bi-eye" id="eye2"></i>
        </span>
      </div>

      {{-- Submit --}}
      <div class="d-grid mb-3">
        <button type="submit" class="btn btn-primary">
          <i class="bi bi-check-circle me-1"></i> Reset Password
        </button>
      </div>

      <div class="text-center">
        <a href="{{ route('adminloginform') }}" class="text-decoration-none small">
          <i class="bi bi-arrow-left me-1"></i> Back to Sign In
        </a>
      </div>
    </form>
  </div>
</div>
@endsection

@push('scripts')
<script>
  function togglePass(inputId, iconId) {
    const inp = document.getElementById(inputId);
    const icon = document.getElementById(iconId);
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
