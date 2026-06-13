@extends('layouts.app1')
@section('content')

<x-danger-alert />
<x-success-alert />

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Deposit Information</h5>
        <div>
            @if($deposit->status == 'Processed')
                <span class="badge bg-success fs-6">Processed</span>
            @elseif($deposit->status == 'Pending')
                <span class="badge bg-warning text-dark fs-6">Pending</span>
                <a href="{{ route('admin.process.deposit', $deposit->id) }}" class="btn btn-sm btn-success ms-2">
                    <i class="bi bi-check-circle me-1"></i> Mark Processed
                </a>
            @else
                <span class="badge bg-danger fs-6">{{ $deposit->status }}</span>
            @endif
        </div>
    </div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <h6 class="text-muted border-bottom pb-1">Deposit Details</h6>
                <table class="table table-sm table-borderless">
                    <tr><th>Deposit ID</th><td>{{ $deposit->id }}</td></tr>
                    <tr><th>Amount</th><td>{{ $settings->s_currency }} {{ number_format($deposit->amount, 2) }}</td></tr>
                    <tr><th>Payment Method</th><td>{{ $deposit->payment_mode }}</td></tr>
                    @if($deposit->transaction_id)
                        <tr><th>Transaction ID</th><td>{{ $deposit->transaction_id }}</td></tr>
                    @endif
                    <tr><th>Date</th><td>{{ \Carbon\Carbon::parse($deposit->created_at)->format('M d, Y h:i A') }}</td></tr>
                    <tr><th>Payment Proof</th><td>
                        @if($deposit->proof)
                            <a href="{{ route('admin.view.depositimage', $deposit->id) }}" class="btn btn-sm btn-info">
                                <i class="bi bi-image me-1"></i> View Proof
                            </a>
                        @else
                            <span class="text-muted">No proof uploaded</span>
                        @endif
                    </td></tr>
                </table>
            </div>
            <div class="col-md-6">
                <h6 class="text-muted border-bottom pb-1">Shipment Information</h6>
                <table class="table table-sm table-borderless">
                    <tr><th>Tracking Number</th>
                        <td><a href="{{ route('admin.shipments.view', $deposit->user) }}" class="text-primary">{{ $deposit->trackingnumber }}</a></td>
                    </tr>
                    <tr><th>Customer Name</th><td>{{ $deposit->name }}</td></tr>
                    <tr><th>Email</th><td>{{ $deposit->email }}</td></tr>
                </table>
            </div>
        </div>

        @if($deposit->payment_details)
            <div class="mt-3">
                <h6 class="text-muted border-bottom pb-1">Payment Details</h6>
                <div class="border rounded p-3 bg-body-secondary">{{ $deposit->payment_details }}</div>
            </div>
        @endif

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('admin.shipment.deposits') }}" class="btn btn-secondary">
                <i class="bi bi-arrow-left me-1"></i> Back to Deposits
            </a>
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                <i class="bi bi-trash me-1"></i> Delete Deposit
            </button>
        </div>
    </div>
</div>

{{-- Delete Modal --}}
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">Are you sure you want to delete this deposit record? This action cannot be undone.</div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <a href="{{ route('admin.delete.deposit', $deposit->id) }}" class="btn btn-danger">Delete</a>
            </div>
        </div>
    </div>
</div>
@endsection
