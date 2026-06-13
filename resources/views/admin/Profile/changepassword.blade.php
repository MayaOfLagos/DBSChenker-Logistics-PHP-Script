@extends('layouts.app1')
@section('content')
<x-danger-alert />
<x-success-alert />

<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Change Your Password</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('adminupdatepass') }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ Auth('admin')->User()->id }}">
                    <input type="hidden" name="current_password" value="{{ Auth('admin')->User()->password }}">

                    <div class="mb-3">
                        <label class="form-label">Old Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" name="old_password" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">New Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
                        <input type="password" class="form-control" name="password_confirmation" required>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-lock me-1"></i> Change Password
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
