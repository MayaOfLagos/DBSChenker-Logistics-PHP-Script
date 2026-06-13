@extends('layouts.admin-auth')
@section('title', 'Forgot Password')

@section('content')
<div class="card card-outline card-primary">
  <div class="card-header text-center">
    <p class="login-box-msg fw-semibold fs-5 mb-0">
      <i class="bi bi-key me-1"></i> Forgot Password?
    </p>
    <small class="text-muted">Enter your email and we'll send reset instructions</small>
  </div>

  <div class="card-body">
    <form method="POST" action="{{ route('sendpasswordrequest') }}">
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

      {{-- Submit --}}
      <div class="d-grid mb-3">
        <button type="submit" class="btn btn-primary">
          <i class="bi bi-send me-1"></i> Send Reset Link
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
