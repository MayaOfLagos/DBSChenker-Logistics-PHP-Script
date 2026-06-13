@extends('layouts.app1')
@section('content')
<x-danger-alert />
<x-success-alert />
<div class="card">
    <div class="card-header"><h5 class="card-title mb-0">Manage Client Withdrawals</h5></div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover mb-0" id="ShipTable">
                <thead class="table-dark">
                    <tr>
                        <th>Client Name</th><th>Amount Requested</th><th>Amount + Charges</th>
                        <th>Payment Method</th><th>Receiver Email</th><th>Status</th>
                        <th>Date</th><th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($withdrawals as $deposit)
                        <tr>
                            <td>{{ $deposit->name }}</td>
                            <td>{{ $settings->s_currency }}{{ number_format($deposit->amount, 2) }}</td>
                            <td>{{ $settings->s_currency }}{{ number_format($deposit->amount + ($deposit->charges_amount ?? 0), 2) }}</td>
                            <td>{{ $deposit->payment_mode }}</td>
                            <td>{{ $deposit->email }}</td>
                            <td>
                                @if($deposit->status == 'Processed')
                                    <span class="badge bg-success">{{ $deposit->status }}</span>
                                @elseif($deposit->status == 'Pending')
                                    <span class="badge bg-warning text-dark">{{ $deposit->status }}</span>
                                @else
                                    <span class="badge bg-danger">{{ $deposit->status }}</span>
                                @endif
                            </td>
                            <td>{{ date('M d, Y H:i', strtotime($deposit->created_at)) }}</td>
                            <td>
                                @if($deposit->status != 'Processed')
                                    <a href="{{ route('processwithdraw', $deposit->id) }}" class="btn btn-success btn-sm me-1">Process</a>
                                @endif
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
<script>$(document).ready(function(){ $('#ShipTable').DataTable({ responsive: true, order: [[6,'desc']] }); });</script>
@endpush
