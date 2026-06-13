@extends('layouts.app1')
@section('content')
<x-danger-alert />
<x-success-alert />

<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">Create a New Shipment</h5>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('createuser') }}" enctype="multipart/form-data">
            @csrf

            <div class="card mb-3">
                <div class="card-header"><h6 class="mb-0">Recipient Information</h6></div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Receiver's Full Name</label>
                            <input type="text" class="form-control" name="name" placeholder="Receiver's full name">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Receiver's Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="email" placeholder="Receiver's email" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Receiver's Phone Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="phone" placeholder="Phone number" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Receiver's Contact Address <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="address" placeholder="Contact address" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Recipient Country <span class="text-danger">*</span></label>
                            <select class="form-control" name="country" required>
                                @include('auth.countries')
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header"><h6 class="mb-0">Sender Information</h6></div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Sender Full Name</label>
                            <input type="text" class="form-control" name="sname" placeholder="Sender full name">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Sender Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="semail" placeholder="Sender email" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Sender Phone Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="sphone" placeholder="Sender phone number" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Sender Contact Address <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="saddress" placeholder="Sender address" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Sender Country <span class="text-danger">*</span></label>
                            <select class="form-control" name="scountry" required>
                                @include('auth.countries')
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header"><h6 class="mb-0">Shipping Information</h6></div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Freight Type <span class="text-danger">*</span></label>
                            <select class="form-control" name="freight_type" required>
                                <option value="Air Freight">Air Freight</option>
                                <option value="Sea Freight">Sea Freight</option>
                                <option value="Road Freight">Road Freight</option>
                                <option value="Rail Freight">Rail Freight</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Weight (e.g. 2kg) <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="weight" placeholder="Weight" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Shipment Status <span class="text-danger">*</span></label>
                            <select class="form-control" name="status" required>
                                @foreach(['Order confirmed','Picked by Courier','On The Way','Custom Hold','Delivered','Approved','Available','Pending'] as $s)
                                    <option value="{{ $s }}">{{ $s }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Date Shipped <span class="text-danger">*</span></label>
                            <input type="datetime-local" class="form-control" name="date_shipped" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Expected Delivery Date <span class="text-danger">*</span></label>
                            <input type="datetime-local" class="form-control" name="expected_delivery" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tracking Number <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="trackingnumber" value="{{ $trackingnumber }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Upload Photo</label>
                            <input type="file" class="form-control" name="photo" accept="image/*">
                        </div>
                    </div>
                </div>
            </div>

            <div class="card mb-3">
                <div class="card-header"><h6 class="mb-0 text-danger">Cost &amp; Payment</h6></div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label text-danger">Shipment Cost</label>
                            <input type="number" class="form-control" name="cost" placeholder="Enter Shipping Cost">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-danger">Clearance Cost</label>
                            <input type="number" class="form-control" name="clearance_cost" placeholder="Enter Clearance Cost">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-danger">Payment Status <span class="text-danger">*</span></label>
                            <select class="form-control" name="qty" required>
                                <option value="Paid">Paid</option>
                                <option value="Unpaid">Unpaid</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Delivery Percentage Completed</label>
                            <input type="number" class="form-control" name="percentage_complete" placeholder="0-100">
                        </div>
                    </div>
                </div>
            </div>

            <button type="submit" class="btn btn-primary">
                <i class="bi bi-truck me-1"></i> Generate Tracking
            </button>
        </form>
    </div>
</div>
@endsection
