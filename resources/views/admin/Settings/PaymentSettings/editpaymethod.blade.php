@extends('layouts.app1')
@section('content')
<x-danger-alert />
<x-success-alert />

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">Update Payment Method</h5>
                <a href="{{ route('paymentview') }}" class="btn btn-sm btn-secondary">
                    <i class="bi bi-arrow-left me-1"></i> Back
                </a>
            </div>
            <div class="card-body">
                @if($method->name == 'USDT')
                    <div class="alert alert-info">
                        For USDT withdrawals via Binance with automatic mode, whitelist users' IP addresses on your Binance merchant dashboard. Collect IPs from user login activities.
                    </div>
                @endif

                <form method="POST" action="{{ route('updatemethod') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $method->id }}">

                    <div class="row g-3">
                        <div class="col-md-12">
                            <label class="form-label">Name</label>
                            @if($method->defaultpay == 'yes')
                                <input type="text" class="form-control" name="name" value="{{ $method->name }}" readonly>
                            @else
                                <input type="text" class="form-control" name="name" value="{{ $method->name }}" required>
                            @endif
                            @if($method->name == 'Credit Card')
                                <small class="text-muted">Ensure you have selected a credit card provider from payment preference tab.</small>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Minimum Amount <small class="text-muted">(withdrawal only)</small></label>
                            <input type="number" class="form-control" name="minimum" value="{{ $method->minimum }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Maximum Amount <small class="text-muted">(withdrawal only)</small></label>
                            <input type="number" class="form-control" name="maximum" value="{{ $method->maximum }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Charges <small class="text-muted">(withdrawal only)</small></label>
                            <input type="number" class="form-control" name="charges" value="{{ $method->charges_amount }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Charges Type</label>
                            <select class="form-control" name="chargetype" required>
                                <option value="{{ $method->charges_type }}">{{ $method->charges_type }}</option>
                                <option value="percentage">Percentage (%)</option>
                                <option value="fixed">Fixed ({{ $settings->currency }})</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Type</label>
                            <select class="form-control" name="methodtype" id="methodtype" required>
                                <option value="{{ $method->methodtype }}">{{ $method->methodtype }}</option>
                                <option value="currency">Currency</option>
                                <option value="crypto">Crypto</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Image URL</label>
                            <input type="text" class="form-control" name="url" value="{{ $method->img_url }}">
                        </div>

                        {{-- Currency Fields --}}
                        <div class="col-md-6 currency-field">
                            <label class="form-label">Bank Name</label>
                            <input type="text" class="form-control currinput" name="bank" value="{{ $method->bankname }}">
                        </div>
                        <div class="col-md-6 currency-field">
                            <label class="form-label">Account Name</label>
                            <input type="text" class="form-control currinput" name="account_name" value="{{ $method->account_name }}">
                        </div>
                        <div class="col-md-6 currency-field">
                            <label class="form-label">Account Number</label>
                            <input type="number" class="form-control currinput" name="account_number" value="{{ $method->account_number }}">
                        </div>
                        <div class="col-md-6 currency-field">
                            <label class="form-label">Swift / Other Code</label>
                            <input type="text" class="form-control currinput" name="swift" value="{{ $method->swift_code }}">
                        </div>

                        {{-- Crypto Fields --}}
                        <div class="col-md-6 crypto-field d-none">
                            <label class="form-label">Wallet Address</label>
                            <input type="text" class="form-control cryptoinput" name="walletaddress" value="{{ $method->wallet_address }}">
                        </div>
                        <div class="col-md-6 crypto-field d-none">
                            <label class="form-label">Barcode Image</label>
                            <input type="file" class="form-control" name="barcode" accept="image/*">
                            @if($method->barcode)
                                <img src="{{ asset('storage/' . ltrim($method->barcode, '/')) }}" class="img-thumbnail mt-2" style="max-height:90px;" alt="Current barcode">
                            @endif
                        </div>
                        <div class="col-md-6 crypto-field d-none">
                            <label class="form-label">Network Type</label>
                            <input type="text" class="form-control cryptoinput" name="wallettype" value="{{ $method->network }}">
                            @if(in_array($method->name, ['USDT','BUSD']))
                                <small class="text-muted">USDT: TRC20 | BUSD: ERC20 for automatic payments.</small>
                            @endif
                        </div>

                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select class="form-control" name="status" required>
                                <option value="{{ $method->status }}">{{ $method->status }}</option>
                                <option value="enabled">Enable</option>
                                <option value="disabled">Disable</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Type For</label>
                            <select class="form-control" name="typefor" required>
                                <option value="{{ $method->type }}">{{ $method->type }}</option>
                                <option value="withdrawal">Withdrawal</option>
                                <option value="deposit">Deposit</option>
                                <option value="both">Both</option>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Optional Note</label>
                            <input type="text" class="form-control" name="note" value="{{ $method->duration }}" placeholder="Payment may take up to 24 hours">
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary px-4">
                                <i class="bi bi-save me-1"></i> Save Changes
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    var methodtype = document.getElementById('methodtype');
    var currencyFields = document.querySelectorAll('.currency-field');
    var cryptoFields = document.querySelectorAll('.crypto-field');
    var currinputs = document.querySelectorAll('.currinput');
    var cryptoinputs = document.querySelectorAll('.cryptoinput');

    function toggleFields() {
        if (methodtype.value === 'currency') {
            currencyFields.forEach(function(el) { el.classList.remove('d-none'); });
            cryptoFields.forEach(function(el) { el.classList.add('d-none'); });
            currinputs[0] && currinputs[0].setAttribute('required', '');
            currinputs[1] && currinputs[1].setAttribute('required', '');
            currinputs[2] && currinputs[2].setAttribute('required', '');
            cryptoinputs.forEach(function(el) { el.removeAttribute('required'); });
        } else {
            currencyFields.forEach(function(el) { el.classList.add('d-none'); });
            cryptoFields.forEach(function(el) { el.classList.remove('d-none'); });
            currinputs.forEach(function(el) { el.removeAttribute('required'); });
            cryptoinputs[0] && cryptoinputs[0].setAttribute('required', '');
            cryptoinputs[2] && cryptoinputs[2].setAttribute('required', '');
        }
    }

    methodtype.addEventListener('change', toggleFields);
    toggleFields();
});
</script>
@endpush
