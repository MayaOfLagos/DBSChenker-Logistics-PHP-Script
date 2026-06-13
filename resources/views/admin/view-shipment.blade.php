@extends('layouts.app1')
@section('content')
<x-danger-alert />
<x-success-alert />

{{-- Action Buttons --}}
<div class="d-flex flex-wrap gap-2 mb-3">
    <a href="{{ route('admin.shipments') }}" class="btn btn-secondary"><i class="bi bi-arrow-left me-1"></i> Back</a>
    <a href="{{ route('admin.shipments.update-status-form', $shipment->id) }}" class="btn btn-info"><i class="bi bi-truck me-1"></i> Update Status</a>
    <a href="{{ route('admin.shipments.edit', $shipment->id) }}" class="btn btn-warning"><i class="bi bi-pencil me-1"></i> Edit</a>
    <a href="{{ route('admin.shipments.print', $shipment->id) }}" target="_blank" class="btn btn-secondary"><i class="bi bi-printer me-1"></i> Print</a>
    <a href="{{ route('admin.delete.shipment', $shipment->id) }}" class="btn btn-danger"
        onclick="return confirm('Delete this shipment?')"><i class="bi bi-trash me-1"></i> Delete</a>
</div>

{{-- Tracking Card --}}
<div class="card mb-3">
    <div class="card-body text-center">
        <img src="https://barcode.tec-it.com/barcode.ashx?data={{ $shipment->trackingnumber }}&code=Code128"
            alt="{{ $shipment->trackingnumber }}" class="img-fluid mb-2" style="max-height:80px;">
        <div class="fw-bold font-monospace fs-5">{{ $shipment->trackingnumber }}</div>
        @if($shipment->status == 'Delivered')
            <span class="badge bg-success fs-6">{{ $shipment->status }}</span>
        @elseif($shipment->status == 'Custom Hold')
            <span class="badge bg-warning text-dark fs-6">{{ $shipment->status }}</span>
        @else
            <span class="badge bg-info text-dark fs-6">{{ $shipment->status }}</span>
        @endif
        <div class="text-muted mt-1 small">
            Created on {{ \Carbon\Carbon::parse($shipment->created_at)->format('F d, Y \a\t h:i A') }}
        </div>
    </div>
</div>

@php
    $shipmentPhoto = $shipment->photo ?? null;
    $shipmentPhotoUrl = $shipmentPhoto
        ? (\Illuminate\Support\Str::startsWith($shipmentPhoto, 'shipment_photos/')
            ? asset($shipmentPhoto)
            : asset('storage/' . ltrim($shipmentPhoto, '/')))
        : null;
@endphp

<div class="row g-3 mb-3">
    {{-- Sender --}}
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header bg-primary text-white"><h5 class="card-title mb-0">Sender Information</h5></div>
            <div class="card-body">
                <table class="table table-borderless mb-0">
                    <tr><th style="width:35%">Name:</th><td>{{ $shipment->sname }}</td></tr>
                    <tr><th>Address:</th><td>{{ $shipment->saddress }}</td></tr>
                    <tr><th>Origin:</th><td>{{ $shipment->take_off_point }}</td></tr>
                </table>
            </div>
        </div>
    </div>
    {{-- Receiver --}}
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header bg-primary text-white"><h5 class="card-title mb-0">Receiver Information</h5></div>
            <div class="card-body">
                <table class="table table-borderless mb-0">
                    <tr><th style="width:35%">Name:</th><td>{{ $shipment->name }}</td></tr>
                    <tr><th>Email:</th><td><a href="mailto:{{ $shipment->email }}">{{ $shipment->email }}</a></td></tr>
                    <tr><th>Phone:</th><td><a href="tel:{{ $shipment->phone }}">{{ $shipment->phone }}</a></td></tr>
                    <tr><th>Address:</th><td>{{ $shipment->address }}</td></tr>
                    <tr><th>Destination:</th><td>{{ $shipment->final_destination }}</td></tr>
                </table>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mb-3">
    {{-- Package --}}
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header bg-primary text-white"><h5 class="card-title mb-0">Package Details</h5></div>
            <div class="card-body">
                <table class="table table-borderless mb-0">
                    <tr><th style="width:35%">Quantity:</th><td>{{ $shipment->qty }}</td></tr>
                    <tr><th>Description:</th><td>{{ $shipment->description }}</td></tr>
                    @if($shipment->photo)
                    <tr><th>Photo:</th><td>
                        <a href="{{ $shipmentPhotoUrl }}" target="_blank">
                            <img src="{{ $shipmentPhotoUrl }}" class="img-thumbnail" style="max-height:150px;">
                        </a>
                    </td></tr>
                    @endif
                </table>
            </div>
        </div>
    </div>
    {{-- Cost --}}
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header bg-primary text-white"><h5 class="card-title mb-0">Cost Information</h5></div>
            <div class="card-body">
                <table class="table table-borderless mb-0">
                    <tr><th style="width:50%">Shipping Cost:</th><td>{{ $settings->s_currency }} {{ number_format($shipment->cost, 2) }}</td></tr>
                    <tr><th>Clearance Cost:</th><td>{{ $settings->s_currency }} {{ number_format($shipment->clearance_cost, 2) }}</td></tr>
                    <tr class="table-active fw-bold"><th>Total Cost:</th><td>{{ $settings->s_currency }} {{ number_format($shipment->cost + $shipment->clearance_cost, 2) }}</td></tr>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Tracking History --}}
<div class="card">
    <div class="card-header bg-primary text-white"><h5 class="card-title mb-0">Tracking History</h5></div>
    <div class="card-body">
        @forelse($tracks as $track)
            <div class="d-flex mb-3 pb-3 border-bottom">
                <div class="me-3">
                    @if($track->status == 'Delivered')
                        <span class="badge bg-success p-2"><i class="bi bi-check-lg fs-5"></i></span>
                    @elseif($track->status == 'Custom Hold')
                        <span class="badge bg-warning text-dark p-2"><i class="bi bi-exclamation-triangle fs-5"></i></span>
                    @else
                        <span class="badge bg-info text-dark p-2"><i class="bi bi-truck fs-5"></i></span>
                    @endif
                </div>
                <div>
                    <div class="text-muted small">{{ \Carbon\Carbon::parse($track->created_at)->format('F d, Y - h:i A') }}</div>
                    <div class="fw-bold">{{ $track->status }}
                        @if($track->address)
                            <span class="text-muted fw-normal ms-2"><i class="bi bi-geo-alt"></i> {{ $track->address }}</span>
                        @endif
                    </div>
                    <div>{{ $track->comment }}</div>
                </div>
            </div>
        @empty
            <p class="text-center text-muted">No tracking history found.</p>
        @endforelse
    </div>
</div>
@endsection
