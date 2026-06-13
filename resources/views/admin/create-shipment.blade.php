@extends('layouts.app1')
@section('content')
<x-danger-alert />
<x-success-alert />

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('admin.shipments.store') }}" enctype="multipart/form-data">
@csrf

<div class="card mb-3">
    <div class="card-header"><h5 class="card-title mb-0">Sender Information</h5></div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Sender Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="sname" value="{{ old('sname') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Sender Email</label>
                <input type="email" class="form-control" name="semail" value="{{ old('semail') }}">
                <small class="text-muted">Optional: for notifications to sender</small>
            </div>
            <div class="col-md-12">
                <label class="form-label">Sender Address <span class="text-danger">*</span></label>
                <textarea class="form-control" name="saddress" rows="2" required>{{ old('saddress') }}</textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label">Origin Location <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="take_off_point" value="{{ old('take_off_point') }}" required>
            </div>
        </div>
    </div>
</div>

<div class="card mb-3">
    <div class="card-header"><h5 class="card-title mb-0">Receiver Information</h5></div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Receiver Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Receiver Email <span class="text-danger">*</span></label>
                <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Receiver Phone <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="phone" value="{{ old('phone') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Destination Location <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="final_destination" value="{{ old('final_destination') }}" required>
            </div>
            <div class="col-md-12">
                <label class="form-label">Receiver Address <span class="text-danger">*</span></label>
                <textarea class="form-control" name="address" rows="2" required>{{ old('address') }}</textarea>
            </div>
        </div>
    </div>
</div>

<div class="card mb-3">
    <div class="card-header"><h5 class="card-title mb-0">Shipment Details</h5></div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Quantity <span class="text-danger">*</span></label>
                <input type="number" class="form-control" name="qty" min="1" value="{{ old('qty', 1) }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Weight (kg)</label>
                <input type="number" step="0.01" class="form-control" name="weight" value="{{ old('weight') }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Dimensions (LxWxH)</label>
                <input type="text" class="form-control" name="dimensions" placeholder="e.g. 30x20x15 cm" value="{{ old('dimensions') }}">
            </div>
            <div class="col-md-6">
                <label class="form-label">Shipment Photo</label>
                <input type="file" class="form-control" name="photo">
            </div>
            <div class="col-md-12">
                <label class="form-label">Package Description <span class="text-danger">*</span></label>
                <textarea class="form-control" name="description" rows="3" required>{{ old('description') }}</textarea>
            </div>
            <div class="col-md-6">
                <label class="form-label">Shipping Method <span class="text-danger">*</span></label>
                <select class="form-control" name="freight_type" required>
                    @foreach(['Road' => 'Road Transport','Air' => 'Air Freight','Sea' => 'Sea Freight','Rail' => 'Rail Transport','Multimodal' => 'Multimodal Transport'] as $val => $label)
                        <option value="{{ $val }}" {{ old('freight_type') == $val ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Shipment Status <span class="text-danger">*</span></label>
                <select class="form-control" name="status" required>
                    @foreach(['Order Confirmed','Picked by Courier','On The Way','Custom Hold','Delivered','Approved','Available','Pending'] as $s)
                        <option value="{{ $s }}" {{ old('status') == $s ? 'selected' : '' }}>{{ $s }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <label class="form-label">Date Shipped <span class="text-danger">*</span></label>
                <input type="datetime-local" class="form-control" name="date_shipped" value="{{ old('date_shipped') }}" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Expected Delivery Date <span class="text-danger">*</span></label>
                <input type="datetime-local" class="form-control" name="expected_delivery" value="{{ old('expected_delivery') }}" required>
            </div>
        </div>
    </div>
</div>

<div class="card mb-3">
    <div class="card-header"><h5 class="card-title mb-0 text-danger">Cost &amp; Payment</h5></div>
    <div class="card-body">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label text-danger">Shipping Cost <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text">{{ $settings->s_currency }}</span>
                    <input type="number" step="0.01" class="form-control" id="cost" name="cost" value="{{ old('cost', 0) }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label text-danger">Clearance Cost <span class="text-danger">*</span></label>
                <div class="input-group">
                    <span class="input-group-text">{{ $settings->s_currency }}</span>
                    <input type="number" step="0.01" class="form-control" id="clearance_cost" name="clearance_cost" value="{{ old('clearance_cost', 0) }}" required>
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label">Total Cost</label>
                <div class="input-group">
                    <span class="input-group-text">{{ $settings->s_currency }}</span>
                    <input type="text" class="form-control" id="total_cost" readonly>
                </div>
            </div>
            <div class="col-md-6">
                <label class="form-label text-danger">Payment Status <span class="text-danger">*</span></label>
                <select class="form-control" name="cstatus" required>
                    <option value="Paid" {{ old('cstatus') == 'Paid' ? 'selected' : '' }}>Paid</option>
                    <option value="Unpaid" {{ old('cstatus') == 'Unpaid' ? 'selected' : '' }}>Unpaid</option>
                </select>
            </div>
            <div class="col-md-12">
                <label class="form-label">Delivery Percentage Completed</label>
                <input type="number" class="form-control" name="percentage_complete" value="{{ old('percentage_complete', 0) }}" min="0" max="100">
            </div>
        </div>
    </div>
</div>

<div class="d-flex gap-2">
    <button type="submit" class="btn btn-primary"><i class="bi bi-save me-1"></i> Create Shipment</button>
    <a href="{{ route('admin.shipments') }}" class="btn btn-secondary"><i class="bi bi-x-circle me-1"></i> Cancel</a>
</div>

</form>
@endsection

@push('scripts')
<script>
$(document).ready(function() {
    function calcTotal() {
        var s = parseFloat($('#cost').val()) || 0;
        var c = parseFloat($('#clearance_cost').val()) || 0;
        $('#total_cost').val((s + c).toFixed(2));
    }
    $('#cost, #clearance_cost').on('input', calcTotal);
    calcTotal();
});
</script>
@endpush
