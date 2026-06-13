@extends('layouts.app1')
@section('content')
<x-danger-alert />
<x-success-alert />
<div class="card">
    <div class="card-header"><h5 class="card-title mb-0">Manage Client Deposits</h5></div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-bordered table-striped table-hover mb-0" id="ShipTable">
                <thead class="table-dark">
                    <tr>
                        <th>Client Name</th><th>Client Email</th><th>Amount</th>
                        <th>Payment Method</th><th>Status</th><th>Date</th><th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($deposits as $deposit)
                        <tr>
                            <td>{{ $deposit->name }}</td>
                            <td>{{ $deposit->email }}</td>
                            <td>{{ $settings->s_currency }}{{ number_format($deposit->amount, 2) }}</td>
                            <td>{{ $deposit->payment_mode }}</td>
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
                                    <a href="{{ url('admin/dashboard/pdeposit') }}/{{ $deposit->id }}" class="btn btn-success btn-sm me-1">Process</a>
                                @endif
                                <a href="{{ url('admin/dashboard/deldeposit') }}/{{ $deposit->id }}" class="btn btn-danger btn-sm"
                                    onclick="return confirm('Delete?')"><i class="bi bi-trash"></i></a>
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
<script>$(document).ready(function(){ $('#ShipTable').DataTable({ responsive: true }); });</script>
@endpush
