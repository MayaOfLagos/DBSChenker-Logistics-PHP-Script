@extends('layouts.app1')
@section('content')
<x-danger-alert />
<x-success-alert />

<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Manage Shipment Deposits</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover mb-0" id="ShipTable">
                <thead class="table-dark">
                    <tr>
                        <th>Client Name</th>
                        <th>Client Email</th>
                        <th>Amount</th>
                        <th>Payment Method</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($deposits as $deposit)
                        <tr>
                            <td>
                                @if($deposit->user > 0)
                                    {{ $deposit->name ?? 'N/A' }}
                                @else
                                    {{ $deposit->guest_name ?? 'Guest User' }}
                                @endif
                            </td>
                            <td>
                                @if($deposit->user > 0)
                                    {{ $deposit->email ?? 'N/A' }}
                                @else
                                    {{ $deposit->guest_email ?? 'N/A' }}
                                @endif
                            </td>
                            <td>{{ $settings->s_currency ?? '$' }}{{ number_format($deposit->amount) }}</td>
                            <td>{{ $deposit->payment_mode }}</td>
                            <td>
                                @if($deposit->status == 'Processed')
                                    <span class="badge bg-success">{{ $deposit->status }}</span>
                                @else
                                    <span class="badge bg-danger">{{ $deposit->status }}</span>
                                @endif
                            </td>
                            <td>{{ date('M d, Y H:i', strtotime($deposit->created_at)) }}</td>
                            <td>
                                <a href="{{ route('admin.view.deposit', $deposit->id) }}" class="btn btn-primary btn-sm me-1" title="View">
                                    <i class="bi bi-eye"></i>
                                </a>
                                @if($deposit->proof)
                                    <a href="{{ route('admin.view.depositimage', $deposit->id) }}" class="btn btn-info btn-sm me-1" title="View Proof">
                                        <i class="bi bi-image"></i>
                                    </a>
                                @endif
                                @if($deposit->status != 'Processed')
                                    <a href="{{ route('admin.process.deposit', $deposit->id) }}" class="btn btn-success btn-sm me-1">Process</a>
                                @endif
                                <a href="{{ route('admin.delete.deposit', $deposit->id) }}" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Delete this deposit?')">
                                    <i class="bi bi-trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    $('#ShipTable').DataTable({ responsive: true, order: [[5, 'desc']] });
});
</script>
@endpush
