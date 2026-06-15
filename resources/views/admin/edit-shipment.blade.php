@extends('layouts.app1')
@section('content')
<x-danger-alert />
<x-success-alert />

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('admin.shipments.update') }}" enctype="multipart/form-data">
@csrf
<input type="hidden" name="id" value="{{ $shipment->id }}">

@php
    $shipmentPhotoUrl = null;
    if ($shipment->photo) {
        $shipmentPhotoUrl = \Illuminate\Support\Str::startsWith($shipment->photo, 'shipment_photos/')
            ? asset($shipment->photo)
            : asset('storage/' . ltrim($shipment->photo, '/'));
    }
@endphp

{{-- Tracking / Status --}}
<div class="card mb-3">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title mb-0"><i class="bi bi-upc-scan me-2"></i>Tracking &amp; Status</h5>
        <a href="{{ route('admin.shipments') }}" class="btn btn-sm btn-secondary">
            <i class="bi bi-arrow-left me-1"></i> Back
        </a>
    </div>
    <div class="card-body text-center">
        <div class="mb-3">
            <img id="barcode-img"
                src="https://barcode.tec-it.com/barcode.ashx?data={{ $shipment->trackingnumber }}&code=Code128"
                alt="{{ $shipment->trackingnumber }}" class="img-fluid" style="max-height:80px;">
        </div>
        <div class="row g-3 justify-content-center">
            <div class="col-md-4">
                <label class="form-label">Tracking Number</label>
                <input type="text" class="form-control" id="trackingnumber" name="trackingnumber"
                    value="{{ old('trackingnumber', $shipment->trackingnumber) }}" required>
            </div>
            <div class="col-md-4">
                <label class="form-label">Shipment Status</label>
                <select class="form-control" name="status">
                    @foreach($shipmentStatuses as $s)
                        <option value="{{ $s }}" {{ old('status', $shipment->status) == $s ? 'selected' : '' }}>{{ $s }}</option>
                    @endforeach
                </select>
                <small class="text-muted">Use Update Status to send email notifications.</small>
            </div>
            <div class="col-md-4">
                <label class="form-label">Payment Status</label>
                <select class="form-control" name="cstatus">
                    <option value="Paid"   {{ old('cstatus', $shipment->cstatus) == 'Paid'   ? 'selected' : '' }}>Paid</option>
                    <option value="Unpaid" {{ old('cstatus', $shipment->cstatus) == 'Unpaid' ? 'selected' : '' }}>Unpaid</option>
                </select>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mb-3">
    {{-- Sender --}}
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header bg-primary text-white"><h5 class="card-title mb-0">Sender Information</h5></div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Sender Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="sname" value="{{ old('sname', $shipment->sname) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Sender Email</label>
                    <input type="email" class="form-control" name="semail" value="{{ old('semail', $shipment->semail) }}">
                    <small class="text-muted">Optional: for notifications to sender</small>
                </div>
                <div class="mb-3">
                    <label class="form-label">Sender Address <span class="text-danger">*</span></label>
                    <textarea class="form-control" name="saddress" rows="3" required>{{ old('saddress', $shipment->saddress) }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Origin Location <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="take_off_point" value="{{ old('take_off_point', $shipment->take_off_point) }}" required>
                </div>
            </div>
        </div>
    </div>

    {{-- Receiver --}}
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header bg-primary text-white"><h5 class="card-title mb-0">Receiver Information</h5></div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Receiver Name <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="name" value="{{ old('name', $shipment->name) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Receiver Email <span class="text-danger">*</span></label>
                    <input type="email" class="form-control" name="email" value="{{ old('email', $shipment->email) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Receiver Phone <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="phone" value="{{ old('phone', $shipment->phone) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Receiver Address <span class="text-danger">*</span></label>
                    <textarea class="form-control" name="address" rows="3" required>{{ old('address', $shipment->address) }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Destination Location <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="final_destination" value="{{ old('final_destination', $shipment->final_destination) }}" required>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-3 mb-3">
    {{-- Shipment Details --}}
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header bg-primary text-white"><h5 class="card-title mb-0">Shipment Details</h5></div>
            <div class="card-body">
                <div class="row g-2 mb-3">
                    <div class="col-6">
                        <label class="form-label">Quantity <span class="text-danger">*</span></label>
                        <input type="number" class="form-control" name="qty" min="1" value="{{ old('qty', $shipment->qty) }}" required>
                    </div>
                    <div class="col-6">
                        <label class="form-label">Weight (kg)</label>
                        <input type="number" step="0.01" class="form-control" name="weight" value="{{ old('weight', $shipment->weight) }}">
                    </div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Dimensions (L×W×H)</label>
                    <input type="text" class="form-control" name="dimensions" placeholder="e.g. 30x20x15 cm" value="{{ old('dimensions', $shipment->dimensions) }}">
                </div>
                <div class="mb-3">
                    <label class="form-label">Shipping Method <span class="text-danger">*</span></label>
                    <select class="form-control" name="freight_type" required>
                        @foreach($freightTypes as $ft)
                            <option value="{{ $ft }}" {{ old('freight_type', $shipment->freight_type) == $ft ? 'selected' : '' }}>{{ $ft }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Package Description <span class="text-danger">*</span></label>
                    <textarea class="form-control" name="description" rows="3" required>{{ old('description', $shipment->description) }}</textarea>
                </div>
                <div class="mb-3">
                    <label class="form-label">Shipment Photo</label>
                    <input type="file" class="form-control" name="photo">
                    @if($shipmentPhotoUrl)
                        <div class="mt-2">
                            <img src="{{ $shipmentPhotoUrl }}" class="img-thumbnail" style="max-height:120px;" alt="Current photo">
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Cost & Dates --}}
    <div class="col-md-6">
        <div class="card h-100">
            <div class="card-header bg-primary text-white"><h5 class="card-title mb-0">Cost &amp; Dates</h5></div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">Shipping Cost ({{ $settings->s_currency }}) <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" class="form-control" id="cost" name="cost"
                        value="{{ old('cost', $shipment->cost) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Clearance Cost ({{ $settings->s_currency }}) <span class="text-danger">*</span></label>
                    <input type="number" step="0.01" class="form-control" id="clearance_cost" name="clearance_cost"
                        value="{{ old('clearance_cost', $shipment->clearance_cost) }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Total Cost ({{ $settings->s_currency }})</label>
                    <input type="text" class="form-control" id="total_cost" readonly>
                </div>
                <div class="mb-3">
                    <label class="form-label">Delivery Progress (%)</label>
                    <input type="number" class="form-control" name="percentage_complete"
                        value="{{ old('percentage_complete', $shipment->percentage_complete) }}" min="0" max="100">
                </div>
                <div class="mb-3">
                    <label class="form-label">Date Shipped <span class="text-danger">*</span></label>
                    <input type="datetime-local" class="form-control" name="date_shipped"
                        value="{{ old('date_shipped', $shipment->date_shipped ? date('Y-m-d\TH:i', strtotime($shipment->date_shipped)) : '') }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Expected Delivery <span class="text-danger">*</span></label>
                    <input type="datetime-local" class="form-control" name="expected_delivery"
                        value="{{ old('expected_delivery', $shipment->expected_delivery ? date('Y-m-d\TH:i', strtotime($shipment->expected_delivery)) : '') }}" required>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="d-flex gap-2">
    <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Update Shipment</button>
    <a href="{{ route('admin.shipments.view', $shipment->id) }}" class="btn btn-secondary"><i class="bi bi-x-circle me-1"></i> Cancel</a>
</div>

</form>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    function calcTotal() {
        var s = parseFloat(document.getElementById('cost').value) || 0;
        var c = parseFloat(document.getElementById('clearance_cost').value) || 0;
        document.getElementById('total_cost').value = (s + c).toFixed(2);
    }
    document.getElementById('cost').addEventListener('input', calcTotal);
    document.getElementById('clearance_cost').addEventListener('input', calcTotal);
    calcTotal();

    document.getElementById('trackingnumber').addEventListener('input', function() {
        var t = this.value.trim();
        if (t) {
            document.getElementById('barcode-img').src =
                'https://barcode.tec-it.com/barcode.ashx?data=' + encodeURIComponent(t) + '&code=Code128';
        }
    });
});
</script>
@endpush
