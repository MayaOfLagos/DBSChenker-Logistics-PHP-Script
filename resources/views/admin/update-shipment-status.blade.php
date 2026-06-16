@extends('layouts.app1')
@section('content')
<x-danger-alert />
<x-success-alert />

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
@endif

<div class="row g-3">
    {{-- Shipment Info Panel --}}
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-primary text-white"><h5 class="card-title mb-0">Shipment Info</h5></div>
            <div class="card-body text-center">
                <img src="https://barcode.tec-it.com/barcode.ashx?data={{ $shipment->trackingnumber }}&code=Code128"
                    alt="{{ $shipment->trackingnumber }}" class="img-fluid mb-2" style="max-height:70px;">
                <div class="fw-bold font-monospace mb-2">{{ $shipment->trackingnumber }}</div>
                <table class="table table-bordered table-sm text-start">
                    <tr>
                        <th>Status</th>
                        <td>
                            @if($shipment->status == 'Delivered')
                                <span class="badge bg-success">{{ $shipment->status }}</span>
                            @elseif($shipment->status == 'Custom Hold')
                                <span class="badge bg-warning text-dark">{{ $shipment->status }}</span>
                            @else
                                <span class="badge bg-info text-dark">{{ $shipment->status }}</span>
                            @endif
                        </td>
                    </tr>
                    <tr><th>Sender</th><td>{{ $shipment->sname }}</td></tr>
                    <tr><th>Receiver</th><td>{{ $shipment->name }}</td></tr>
                    <tr><th>Origin</th><td>{{ $shipment->take_off_point }}</td></tr>
                    <tr><th>Destination</th><td>{{ $shipment->final_destination }}</td></tr>
                    <tr><th>Created</th><td>{{ \Carbon\Carbon::parse($shipment->created_at)->toDayDateTimeString() }}</td></tr>
                </table>
                <a href="{{ route('admin.shipments.view', $shipment->id) }}" class="btn btn-info btn-sm w-100 mt-2">
                    <i class="bi bi-eye me-1"></i> View Full Details
                </a>
            </div>
        </div>
    </div>

    {{-- Update Form + History --}}
    <div class="col-md-8">
        <div class="card mb-3">
            <div class="card-header bg-primary text-white"><h5 class="card-title mb-0">Update Status</h5></div>
            <div class="card-body">
                <form method="POST" action="{{ route('admin.shipments.update-status') }}">
                    @csrf
                    <input type="hidden" name="shipment_id" value="{{ $shipment->id }}">
                    <div class="mb-3">
                        <label class="form-label">New Status <span class="text-danger">*</span></label>
                        <select class="form-control" name="status" required>
                            <option value="" disabled selected>Select Status</option>
                            @foreach($shipmentStatuses as $s)
                                <option value="{{ $s }}" {{ old('status') == $s ? 'selected' : '' }}>{{ $s }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Current Location <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="location" value="{{ old('location') }}" required>
                        <small class="text-muted">Enter the current location of the shipment</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Comment / Details <span class="text-danger">*</span></label>
                        <textarea class="form-control" name="comment" rows="4" required>{{ old('comment') }}</textarea>
                        <small class="text-muted">This will be visible to the customer</small>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Delivery Progress (%) <small class="text-muted fw-normal"></small></label>
                        <input type="number" class="form-control" name="percentage_complete"
                               value="{{ old('percentage_complete', $shipment->percentage_complete) }}"
                               min="0" max="100" placeholder="{{ $shipment->percentage_complete ?? 0 }}">
                    </div>
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="notify_customer" value="1" id="notify_customer" checked>
                        <label class="form-check-label" for="notify_customer">Send email notification to customer</label>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-send me-1"></i> Update Status
                    </button>
                </form>
            </div>
        </div>

        <div class="card">
            <div class="card-header bg-primary text-white"><h5 class="card-title mb-0">Status History</h5></div>
            <div class="card-body">
                @forelse($tracks as $track)
                    <div class="d-flex mb-3 pb-3 border-bottom">
                        <div class="me-3 mt-1">
                            @if($track->status == 'Delivered')
                                <span class="badge bg-success"><i class="bi bi-check-lg"></i></span>
                            @elseif($track->status == 'Custom Hold')
                                <span class="badge bg-warning text-dark"><i class="bi bi-exclamation-triangle"></i></span>
                            @else
                                <span class="badge bg-info text-dark"><i class="bi bi-truck"></i></span>
                            @endif
                        </div>
                        <div>
                            <div class="fw-semibold">{{ $track->status }}</div>
                            <div class="text-muted small">
                                <i class="bi bi-geo-alt me-1"></i>{{ $track->address }}
                                &nbsp;&mdash;&nbsp;
                                <i class="bi bi-clock me-1"></i>{{ \Carbon\Carbon::parse($track->created_at)->format('M d, Y - h:i A') }}
                            </div>
                            <div>{{ $track->comment }}</div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted text-center">No status updates yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
