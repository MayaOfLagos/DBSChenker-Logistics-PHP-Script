@extends('layouts.app1')
@section('content')
<x-danger-alert />
<x-success-alert />

<div class="mb-3">
    <a href="{{ route('kyc') }}" class="btn btn-secondary btn-sm">
        <i class="bi bi-arrow-left me-1"></i> Back to KYC List
    </a>
</div>

<div class="card mb-3">
    <div class="card-header d-flex justify-content-between align-items-center">
        <div>
            <h5 class="card-title mb-1">{{ $kyc->user->name }} — KYC Application</h5>
            @if($kyc->status == 'Verified')
                <span class="badge bg-success">Verified</span>
            @else
                <span class="badge bg-danger">{{ $kyc->status }}</span>
            @endif
        </div>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#actionModal">
            <i class="bi bi-gear me-1"></i> Process KYC
        </button>
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-12"><h6 class="text-primary border-bottom pb-1">Personal Information</h6></div>
            <div class="col-md-6">
                <div class="text-muted small">First Name</div>
                <div class="fs-5">{{ $kyc->first_name }}</div>
            </div>
            <div class="col-md-6">
                <div class="text-muted small">Last Name</div>
                <div class="fs-5">{{ $kyc->last_name }}</div>
            </div>
            <div class="col-md-6">
                <div class="text-muted small">Email</div>
                <div class="fs-5">{{ $kyc->email }}</div>
            </div>
            <div class="col-md-6">
                <div class="text-muted small">Phone Number</div>
                <div class="fs-5">{{ $kyc->phone_number }}</div>
            </div>
            <div class="col-md-6">
                <div class="text-muted small">Date of Birth</div>
                <div class="fs-5">{{ $kyc->dob }}</div>
            </div>
            <div class="col-md-6">
                <div class="text-muted small">Social Media Username</div>
                <div class="fs-5">{{ $kyc->social_media }}</div>
            </div>

            <div class="col-md-12"><h6 class="text-primary border-bottom pb-1 mt-2">Address Information</h6></div>
            <div class="col-md-6">
                <div class="text-muted small">Address</div>
                <div class="fs-5">{{ $kyc->address }}</div>
            </div>
            <div class="col-md-6">
                <div class="text-muted small">City</div>
                <div class="fs-5">{{ $kyc->city }}</div>
            </div>
            <div class="col-md-6">
                <div class="text-muted small">State</div>
                <div class="fs-5">{{ $kyc->state }}</div>
            </div>
            <div class="col-md-6">
                <div class="text-muted small">Nationality</div>
                <div class="fs-5">{{ $kyc->country }}</div>
            </div>

            <div class="col-md-12"><h6 class="text-primary border-bottom pb-1 mt-2">Document Information</h6></div>
            <div class="col-md-12">
                <div class="text-muted small">Document Type</div>
                <div class="fs-5 mb-3">{{ $kyc->document_type }}</div>
            </div>
            <div class="col-md-6">
                <div class="text-muted small mb-1">Front View</div>
                <img src="{{ asset('storage/' . $kyc->frontimg) }}" class="img-fluid rounded" style="max-height:250px;" alt="Front of document">
            </div>
            <div class="col-md-6">
                <div class="text-muted small mb-1">Back View</div>
                <img src="{{ asset('storage/' . $kyc->backimg) }}" class="img-fluid rounded" style="max-height:250px;" alt="Back of document">
            </div>
        </div>
    </div>
</div>

{{-- Process KYC Modal --}}
<div id="actionModal" class="modal fade" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Process KYC</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('processkyc') }}" method="POST">
                    @csrf
                    <input type="hidden" name="kyc_id" value="{{ $kyc->id }}">
                    <div class="mb-3">
                        <label class="form-label">Action</label>
                        <select name="action" class="form-control" required>
                            <option value="Accept">Accept and verify user</option>
                            <option value="Reject">Reject and remain unverified</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Message</label>
                        <textarea name="message" class="form-control" rows="4" required>This is to inform you that following the documents you submitted, your account has been verified. You can now enjoy all our services without restrictions. Cheers!!</textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email Subject</label>
                        <input type="text" name="subject" class="form-control" placeholder="Account is verified successfully" required>
                    </div>
                    <button type="submit" class="btn btn-primary px-4">Confirm</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
