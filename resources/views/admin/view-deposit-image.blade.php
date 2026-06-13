@extends('layouts.app1')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0">Payment Proof for Deposit #{{ $deposit->id }}</h5>
        <a href="{{ route('admin.view.deposit', $deposit->id) }}" class="btn btn-sm btn-secondary">
            <i class="bi bi-arrow-left me-1"></i> Back to Deposit
        </a>
    </div>
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                <div class="mb-4">
                    <img src="{{ asset('storage/' . ltrim($deposit->proof, '/')) }}" alt="Payment Proof" class="img-fluid rounded shadow-sm" style="max-height:600px;">
                </div>
                <div class="mb-3 d-flex justify-content-center gap-2">
                    <a href="{{ asset('storage/' . ltrim($deposit->proof, '/')) }}" class="btn btn-info" target="_blank">
                        <i class="bi bi-box-arrow-up-right me-1"></i> Open in New Tab
                    </a>
                    <a href="{{ asset('storage/' . ltrim($deposit->proof, '/')) }}" class="btn btn-success" download>
                        <i class="bi bi-download me-1"></i> Download
                    </a>
                </div>
                <div class="alert alert-info text-start">
                    <strong>Deposit Summary</strong><br>
                    Amount: <strong>{{ $settings->s_currency }} {{ number_format($deposit->amount, 2) }}</strong><br>
                    Payment Method: <strong>{{ $deposit->payment_mode }}</strong><br>
                    Status:
                    @if($deposit->status == 'Processed')
                        <span class="badge bg-success">Processed</span>
                    @elseif($deposit->status == 'Pending')
                        <span class="badge bg-warning text-dark">Pending</span>
                    @else
                        <span class="badge bg-danger">{{ $deposit->status }}</span>
                    @endif
                    <br>
                    Date: <strong>{{ \Carbon\Carbon::parse($deposit->created_at)->format('M d, Y h:i A') }}</strong>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
