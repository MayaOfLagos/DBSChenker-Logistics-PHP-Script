@extends('layouts.app1')
@section('content')
<x-danger-alert />
<x-success-alert />

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Account Profile Information</h5>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('upadprofile') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">First Name</label>
                        <input type="text" class="form-control" name="name" value="{{ Auth('admin')->User()->firstName }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Last Name</label>
                        <input type="text" class="form-control" name="lname" value="{{ Auth('admin')->User()->lastName }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Phone Number</label>
                        <input type="text" class="form-control" name="phone" value="{{ Auth('admin')->User()->phone }}">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Two Factor Authentication</label>
                        <select class="form-control" name="token">
                            <option value="{{ Auth('admin')->User()->enable_2fa }}">{{ Auth('admin')->User()->enable_2fa }}</option>
                            <option value="enabled">Enable</option>
                            <option value="disabled">Disable</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-save me-1"></i> Update Profile
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
